<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\EmailOtp;
use App\Models\GiftToken;
use App\Models\GoodWillToken;
use App\Models\TokenHistory;
use App\Models\MyPlan;
use App\Models\Plan;
use App\Models\Offers;
use App\Models\BusinessOperation;
use App\Models\Notification;
//use App\Mail\UserSendOtpMail;
use App\Mail\UserForgotPasswordMail;
use App\Mail\UserRegisterVerifyMail;
use App\Mail\UserRegisterMail;
use App\Mail\UserPaymentMail;
use App\Mail\redeemTokenMail;
use App\Http\Controllers\StripeTrait;
use Mail,Hash,File,Auth,DB,Helper,Exception,Session,Stripe;
use Carbon\Carbon;

class UserAuthController extends Controller
{
    public function register(){
        $countryCode = DB::table('country')->orderBy('phonecode','ASC')->pluck('phonecode','phonecode');
        return view('web.auth.register',compact('countryCode'));
    }

    public function registerSubmit(Request $request){

        $request->validate([
            'business_name' => 'required|string',
            'full_name' => 'required|string',
            'email' => 'required|email|unique:users,email,NULL,id,deleted_at,NULL',
            'country_code' => 'required|numeric',
            'phone' => 'required|numeric|digits_between:9,12|unique:users,phone,NULL,id,deleted_at,NULL',
            'password' => 'required|min:6',
            'repeat_password' => 'required|min:6|same:password',
            'terms_conditions' => 'present'
        ],[
            'full_name.required' => 'The contact person name field is required.'
        ]);

        try{
            //======================== Add User  ===============//

            $terms_conditions = 0;
            if(!empty($request->terms_conditions)){
                $terms_conditions = 1;
            }

            $bissunesdata = [
                'business_name' => $request->business_name,
                'full_name' => $request->full_name,
                'email' => $request->email,
                'country_code' => $request->country_code,
                'phone' => $request->phone,
                'password' => bcrypt($request->password),
                'terms_conditions' => $terms_conditions,
                'role' => 'business',
            ];

            $bissunesInsert = User::create($bissunesdata);
            $bissunesID = $bissunesInsert->id;
            return redirect()->route('register.next',['bissunesID' => base64_encode($bissunesID)]);
        }catch(Exception $e){
            return back()->withInput()->withError($e->getMessage());
        }
    }

    public function registerUpdate(Request $request,$id){
        $request->validate([
            'business_name' => 'required|string',
            'full_name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$id.',id,deleted_at,NULL',
            'country_code' => 'required|numeric',
            'phone' => 'required|numeric|digits_between:9,12|unique:users,phone,'.$id.',id,deleted_at,NULL',
            'address' => 'required',

        ],[
            'full_name.required' => 'The contact person name field is required.',
            'address.required' => 'The location field is required.'
        ]);


        try{
            $avatar = $request->hidden_avatar;
            if($request->file() && $request->file() != 'undefined'){
                $image = $_FILES['file']['name'];
                $name = time().'.'.pathinfo($image,PATHINFO_EXTENSION);
                $destinationPath = public_path('uploads/business/images');
                if(move_uploaded_file($_FILES['file']['tmp_name'],$destinationPath.'/'.$name)){
                    $avatar = 'uploads/business/images/'.$name;
                }
            }

            $bissunesdata = [
                'business_name' => $request->business_name,
                'full_name' => $request->full_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'country_code' => $request->country_code,
                'address' => $request->address,
                'area' => $request->area,
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country,
                'zipcode' => $request->zipcode,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'about' => $request->about,
                'avatar' => $avatar,
            ];

            User::whereId($id)->update($bissunesdata);
            return response()->json(['status'=>'success','message'=>'General info has been updated successfully']);
        }catch(Exception $e){
            return response()->json(['status' => 'error','data' => $e]);
        }
    }

    public function registerUpdateTime(Request $request,$id){

        try{
            if(!empty($request->business_day)) {
                BusinessOperation::where('user_id',$id)->forceDelete();
                $business_day = explode(',',$request->business_day);
                $business_dayChecked = explode(',',$request->business_dayChecked);
                $open_time = explode(',',$request->open_time);
                $close_time = explode(',',$request->close_time);

                foreach($business_day as $key => $businessOper){
                    if(!in_array($businessOper,$business_dayChecked)){
                        continue;
                    }

                    if(empty($open_time[$key]) || empty($close_time[$key])){
                        continue;
                    }

                    $busOpe = [
                        'user_id' => $id,
                        'business_day' => $businessOper,
                        'open_time' => $open_time[$key],
                        'close_time' => $close_time[$key],
                    ];
                    BusinessOperation::create($busOpe);
                }
            }
            return response()->json(['status'=>'success','message'=>'Time has been updated successfully']);
        }catch(Exception $e){
            return response()->json(['status' => 'error','data' => $e]);
        }
    }

    public function registerUpdateCategory(Request $request,$id){

        $request->validate([
            'category' => 'required',
        ]);
        $category = $request->category;

        try{

            $bissunesdata = [
                'category' => $category,
            ];

            User::whereId($id)->update($bissunesdata);
            return response()->json(['status'=>'success','message'=>'Category has been updated successfully']);
        }catch(Exception $e){
            return response()->json(['status' => 'error','data' => $e]);
        }
    }

    public function registerUpdateBank(Request $request,$id){
        $request->validate([
            'bank_name' => 'required|string',
            'bsb' => 'required',
            'account_number' => 'required',
            'repeat_account_number' => 'required|same:account_number',
            'account_holder_name' => 'required'
        ]);

        try{
            $bissunesdata = [
                'bank_name' => $request->bank_name,
                'bsb' => $request->bsb,
                'account_number' => $request->account_number,
                'account_holder_name' => $request->account_holder_name
            ];
            User::whereId($id)->update($bissunesdata);

            return response()->json(['status'=>'success','message'=>'Bank detail has been updated successfully']);
        }catch(Exception $e){
            return response()->json(['status' => 'error','data' => $e]);
        }
    }

    public function registerNext(Request $request){
        $bissunesID = base64_decode($request->bissunesID);
        $categories = Category::pluck('name','id');
        return view('web.auth.register_next',compact('bissunesID','categories'));
    }
    public function registerNextSubmit(Request $request){

        $request->validate([
            'address' => 'required|string',
            'category' => 'required',
            //'open_time.*' => 'required',
            'avatar' => 'required|mimes:jpeg,png,jpg,gif,svg',
        ],
		[
            'address.required' => 'The location field is required.',
			'avatar.required' => 'The image field is required.',
			'avatar.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, svg.'
        ]);

        try{
            //======================== Add Bussiness  ===============//

            if ($request->hasFile('avatar')) {
                $image = $request->file('avatar');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/business/images');
                $image->move($destinationPath, $name);
                $request->avatar = 'uploads/business/images/'.$name;
            }
            $category = implode(',',$request->category);

            $bissunesdata = [
                'address' => $request->address,
                'area' => $request->area,
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country,
                'zipcode' => $request->zipcode,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'category' => $category,
                'avatar' => $request->avatar
            ];
            $bissunesID = $request->id;
            User::where('id',$bissunesID)->update($bissunesdata);

            if(!empty($request->business_day)) {
                foreach($request->business_day as $key => $businessOper){
                    if(empty($request->open_time[$key]) || empty($request->close_time[$key])){
                        continue;
                    }

                    $busOpe = [
                        'user_id' => $bissunesID,
                        'business_day' => $businessOper,
                        'open_time' => $request->open_time[$key],
                        'close_time' => $request->close_time[$key],
                    ];
                    BusinessOperation::create($busOpe);
                }
            }
            return redirect()->route('register.secondNext',['bissunesID' => base64_encode($bissunesID)]);

        }catch(Exception $e){
            return back()->withInput()->withError($e->getMessage());
        }
    }

    public function registerSecondNext(Request $request){
        $encodeBissunesID = $request->bissunesID;
        $bissunesID = base64_decode($request->bissunesID);
        return view('web.auth.register_second_next',compact('encodeBissunesID','bissunesID'));
    }
    public function registerSecondNextSubmit(Request $request){

        $request->validate([
            'bank_name' => 'required|string',
            'bsb' => 'required',
            'account_number' => 'required',
            'repeat_account_number' => 'required|same:account_number',
            'account_holder_name' => 'required'
        ]);

        try{
            //======================== Add Bank  ===============//
            $bissunesdata = [
                'bank_name' => $request->bank_name,
                'bsb' => $request->bsb,
                'account_number' => $request->account_number,
                'account_holder_name' => $request->account_holder_name
            ];
            $bissunesID = $request->id;
            User::where('id',$bissunesID)->update($bissunesdata);
            $user = User::where('id',$bissunesID)->first();
            Mail::to($user->email)->send(new UserRegisterMail($user));


            //Session::forget('register_user');

            //Session::put('register_user', $user);

            /* $curl = new \Stripe\HttpClient\CurlClient();

            $curl->setEnablePersistentConnections(false);

            \Stripe\ApiRequestor::setHttpClient($curl);
            \Stripe\Stripe::setApiKey('sk_test_51LicFNFkV20vz5IvJAd9bcT6sMycEJeD8xdFG81Uzf3cyOJZYjacfP2sQ6ReUdaLYJLsq5VkDhFAtf2oNCktolvm00gXjMn7iA'); */

            /* $stripeCustomer =  StripeTrait::createCustomer(

                [

                    'email' => $user->email,

                    'name' => $user->full_name,

                ]

            );

            User::where('email', $user->email)->update(['stripe_id' => $stripeCustomer['customer_token']]); */
            //Mail::to($user->email)->send(new UserSendEmailVerifyLink($token));
            //return redirect()->route('login_business')->withSuccess('Account created successfully , Please verify your email');

            if(Auth::loginUsingId($bissunesID)) {
                return redirect()->route('redeem.coupon')->withSuccess('Registration has been completed successfully');
            }
        }catch(Exception $e){
            return back()->withInput()->withError($e->getMessage());
        }

    }

    public function verifyEmail(){
        return view('web.auth.email_verify');
    }

    public function verifyEmailSubmit(Request $request){
        try{
            $user = Session::get('register_user');
            $verify_user = EmailOtp::where('email',$user->email)->orderBy('id','desc')->first();
            $date = date('Y-m-d H:i:s');
            $currentTime = strtotime($date);
            if($verify_user){
                if($verify_user->otp == $request->code){
                    if($verify_user->otp_expire_time > $currentTime){
                        $user->email_verified_at = $date;
                        $user->save();
                        $udpate_user = User::find($user->id);
                        $udpate_user->member_id = 'de'.$user->id;
                        $udpate_user->save();
                        Session::forget('register_user');
                        Mail::to($user->email)->send(new UserRegisterVerifyMail($user));
                        return redirect()->route('login.get')->withSuccess('Account created successfully!Please Login.');
                    }else{
                        return back()->withInput()->withError('Verification code expired!');
                    }
                }else{
                    return back()->withInput()->withError('invalid verification code!');
                }
            }else{
                return back()->withInput()->withError('User not found!');
            }

        }catch(Exception $e){
            return back()->withInput()->withError($e->getMessage());
        }
    }

    public function sendOtp(){
        $user = Session::get('register_user');
        if(!$user){
            $user = Session::get('forgot_user');
        }
        $code = rand(1000,9999);
        $date = date('Y-m-d H:i:s');
        $currentDate = strtotime($date);
        $futureDate = $currentDate+(60*5);

        EmailOtp::where('email',$user->email)->forceDelete();
        $email_otp = new EmailOtp();
        $email_otp->email = $user->email;
        $email_otp->otp = $code;
        $email_otp->otp_expire_time = $futureDate;
        $email_otp->save();
        Mail::to($user->email)->send(new UserForgotPasswordMail($user, $code));
    }

    public function login(){
        return view('web.auth.login');
    }

    public function loginSubmit(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        try{
            $credentials = $request->only('email', 'password');
            if(Auth::attempt($credentials)) {
                return redirect()->route('redeem.coupon')->withSuccess('Loggedin Successful');
            }
            return back()->withInput()->withError('You have entered invalid credentials');
        }catch(Exception $e){
            return back()->withInput()->withError($e->getMessage());
        }

    }

    public function forgotPassword(){
        return view('web.auth.forgot_password');
    }

    public function forgotPasswordSubmit(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        try{
            $user = User::where('email',$request->email)->first();
            if(!$user){
                return redirect()->back()->withError('Email address is not exists.');
            }
            $code = rand(1000,9999);
            $date = date('Y-m-d H:i:s');
            $currentDate = strtotime($date);
            $futureDate = $currentDate+(60*5);

            EmailOtp::where('email',$user->email)->forceDelete();
            $email_otp = new EmailOtp();
            $email_otp->email = $user->email;
            $email_otp->otp = $code;
            $email_otp->otp_expire_time = $futureDate;
            $email_otp->save();
            Mail::to($user->email)->send(new UserForgotPasswordMail($user, $code));
            Session::forget('forgot_user');
            Session::put('forgot_user', $user);
            return redirect()->route('verify.forgot-password.get')->withSuccess('Verification code sent successfully on your email address');

        }catch(Exception $e){
            return back()->withInput()->withError($e->getMessage());
        }

    }

    public function verifyForgotPassword(){
        return view('web.auth.forgot_password_verify');
    }

    public function verifyForgotPasswordSubmit(Request $request){
        try{
            $user = Session::get('forgot_user');
            $verify_user = EmailOtp::where('email',$user->email)->orderBy('id','desc')->first();
            $date = date('Y-m-d H:i:s');
            $currentTime = strtotime($date);
            if($verify_user){
                if($verify_user->otp == $request->code){
                    if($verify_user->otp_expire_time > $currentTime){
                        return redirect()->route('reset.password.get')->withSuccess('Verified successfully!Please reset password');
                    }else{
                        return back()->withInput()->withError('Verification code expired!');
                    }
                }else{
                    return back()->withInput()->withError('Invalid verification code!');
                }
            }else{
                return back()->withInput()->withError('User not found!');
            }

        }catch(Exception $e){
            return back()->withInput()->withError($e->getMessage());
        }
    }

    public function resetPassword(){
        return view('web.auth.reset_password');
    }

    public function resetPasswordSubmit(Request $request){
        $request->validate([
            'password' => 'required|confirmed|min:6',
        ]);
        try{
            $user = Session::get('forgot_user');
            if($user){
                if(Hash::check($request->password,$user->password)){
                    return back()->withInput()->withError('Cannot use your old password as new password');
                }else{
                    $user->password = Hash::make($request->password);
                    $user->save();
                    Session::forget('forgot_user');
                    return redirect()->route('login.get')->withSuccess('Password reset successfully!Please Login');
                }
            }
            else{
                return back()->withInput()->withError('User not exist');
            }
        }
        catch(Exception $e){
            return back()->withInput()->withError($e->getMessage());
        }
    }

    public function myAccount(){
        $user = Auth::user();
        return view('web.auth.my_account',compact('user'));
    }

    public function updateMyAccount(Request $request){
        $user = Auth::user();
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users,email,NULL,id,deleted_at,NULL'.$user->id,
            'phone' => 'required|numeric|digits_between:9,12|unique:users,phone,NULL,id,deleted_at,NULL'.$user->id,
            //'email' => 'required|email|unique:users,email,'.$user->id,
            //'phone' => 'required|numeric|digits_between:9,12|unique:users,phone,'.$user->id,
            'business_name' => 'required|string',
            'address' => 'required',
            'avatar'  =>  'sometimes|mimes:jpeg,jpg,png|max:8000',
        ]);

        try{

            //======================== Add User  ===============//
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->full_name = $request->first_name.' '.$request->last_name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->business_name = $request->business_name;
            $user->address = $request->address;
            $user->city = $request->city ?? '';
            $user->state = $request->state ?? '';
            $user->country = $request->country ?? '';
            $user->country_code = $request->country_code ?? '';
            $user->zipcode = $request->zipcode ?? '';
            $user->latitude = $request->latitude ?? '';
            $user->longitude = $request->longitude ?? '';

            $input = $request->all();
            if(array_key_exists('avatar',$input)){
                $file = $request->file('avatar');
                if($file){
                    $filename   = time().$file->getClientOriginalName();
                    $folder = 'uploads/user/';
                    $path = public_path($folder);
                    if(!File::exists($path)) {
                        File::makeDirectory($path, $mode = 0777, true, true);
                    }
                    $file->move($path, $filename);
                    $user->avatar   = $folder.$filename;
                }
            }
            $user->save();
            return back()->withSuccess('Profile updated successfully');
        }catch(Exception $e){
            return back()->withInput()->withError($e->getMessage());
        }
    }

    public function redeemCoupon()
    {
        return view("web.auth.redeem_coupon");
    }

    public function redeemCouponSubmit(Request $request)
    {
        // Check if token code is provided
        if (!$request->has('token_code') || !$request->filled('token_code')) {
            return response()->json([
                'status' => 'error',
                'message' => 'Please enter a token code.',
            ]);
        }

        // Extract and sanitize token code
        $couponCode = trim($request->input('token_code'));

        // Get authenticated user's ID
        $auth_id = Auth::id();

        $date = Carbon::now();

        $checkvalid = $date->format('Y-m-d');

        // Fetch gift token data with associated user details
        $data = GiftToken::with('user:id,full_name,address,avatar,email,country_code,phone')
            ->where([
                ['token_code', $couponCode],
                ['token_validaty', '>=', $checkvalid], // Use Carbon instance for better comparison
                ['bussiness_id', $auth_id],
                ['status', 'active']
            ])->latest()->first();

        // If token data found, calculate balance
        if ($data) {
            $sumAmount = TokenHistory::where('token_id', $data->id)->where('status', '1')->sum('amount');
            $data->balance = $data->token_amount - $sumAmount;

            return response()->json([
                'status' => 'success',
                'data' => $data,
            ]);
        }

        // If no token data found, return error
        return response()->json([
            'status' => 'error',
            'message' => 'Please enter correct token code.',
        ]);
    }

    public function redeemValueSubmit(Request $request){
        // Check if amount is not set or is zero
        if (!$request->amount || $request->amount == 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Please enter amount',
            ]);
        }

        // Calculate sum of current token amount and requested amount
        $amount = TokenHistory::where('token_id', $request->token_id)->where('status', '1')->sum('amount');
        $sumAmount = $amount + $request->amount;

        // Check if redeem amount exceeds total amount
        if ($sumAmount > $request->total_amount) {
            return response()->json([
                'status' => 'error',
                'message' => 'Redeem amount is more than token amount.',
            ]);
        }

        // Prepare data for redemption
        $data = $request->all();
        $data['reedem_date'] = date('Y-m-d');

        // Send OTP and check result
        $getRes = Helper::sendOtp($data);
        if ($getRes !== true) {
            return response()->json([
                'status' => 'error',
                'message' => 'We are unable to proceed, please contact administration.',
            ]);
        }

        // Save token redemption history
        TokenHistory::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'OTP successfully sent.',
            'data' => $data['amount'],
        ]);
    }

    public function redeemResendCode(Request $request){
        $data = $request->all();
        $getRes = Helper::sendOtp($data);

        if($getRes != true){
            return response()->json([
                'status' => 'error',
                'message' => 'We are unable to success, Please contact to administration.',
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'otp successfully sent.',
        ]);
    }

    public function redeemVerifyCode(Request $request){
        if(!$request->v_code){
            return response()->json([
                'status' => 'error',
                'message' => 'Please enter amount.',
            ]);
        }

        $data = $request->all();
        $getRes = Helper::verifyOtp($data);

        if($getRes == null || $getRes == ''){
            return response()->json([
                'status' => 'error',
                'message' => 'Please enter correct verification code.',
            ]);
        }

        TokenHistory::where('token_id',$data['token_id'])->orderBy('id','desc')->first()->update(['status'=> '1']);

        $sumAmount = TokenHistory::where([['token_id',$data['token_id']],['status','1']])->sum('amount');

        if($sumAmount == $data['total_amount']){
            $redeem_date = date('Y-m-d');
            GiftToken::where('id',$data['token_id'])->update(['status'=>'Inactive','redeem_date'=>$redeem_date]);
        }
        EmailOtp::where('email',$data['mobile'])->forceDelete();

        $business_name = User::where('id',$data['business_id'])->value('business_name');
        $created_id = GiftToken::where('bussiness_id',$data['business_id'])->value('createdby');
        $email = User::where('id',$created_id)->value('email');
        $data['business_name'] = $business_name;
        $data['balance'] = $data['total_amount'] - $sumAmount;
        Mail::to($email)->send(new redeemTokenMail($data));
        $notification = [
            'target_id' => 1,
            'user_id' => Auth::user()->id,
            'message' => '$'. $data['redeemAmount'].' redeemed at '. $business_name .' business',
            'date' => date('Y-m-d'),
            'time' => date('H:i a'),
            'target_page' => 'admin/coupon/'.Auth::user()->id
        ];

        Notification::create($notification);

        return response()->json([
            'status' => 'success',
            'data' => '',
        ]);
    }

    public function couponOverview(Request $request)
    {
        $query = GiftToken::where([['bussiness_id',Auth::user()->id],['token_validaty','>=',Date('Y-m-d')],['status','active']])->where('is_goodwill',0);
        $rQuery = GiftToken::where([['bussiness_id',Auth::user()->id],['token_validaty','>=',Date('Y-m-d')],['status','inactive']])->whereNotNull('redeem_date')->where('is_goodwill',0);
        if($request->filter){
            $filter = $request->filter;
            $status = $request->status;

            if($filter == 'amount'){
                $query->orderBy('token_amount','Desc');
                $rQuery->orderBy('token_amount','Desc');
            }else if($filter == 'newest'){
                $query->orderBy('id','Desc');
                $rQuery->orderBy('id','Desc');
            }else{
                $query->orderBy('id','Desc');
                $rQuery->orderBy('id','Desc');
            }
            $data = '';
           // DB::connection()->enableQueryLog();
            if($status == 'Active'){
                $data = $query->take(10)->get();
            }else if($status == 'Inactive'){
                $data = $rQuery->take(10)->get();
                //dd($data);
            }
            //dd(DB::getQueryLog());
            return response()->json([
                'data' => $data
            ]);

        }else{
            $query->orderBy('id','Desc');
            $rQuery->orderBy('id','Desc');
        }


        $activeToken = $query->take(10)->get();
        $redeemToken = $rQuery->take(10)->get();
        //dd($activeToken);
        //$expireToken = GiftToken::where([['bussiness_id',Auth::user()->id],['token_validaty','<',Date('Y-m-d')],['status','Active']])->orderBy('id','Desc')->get();
        $activeCount = GiftToken::where([['bussiness_id',Auth::user()->id],['token_validaty','>=',Date('Y-m-d')],['status','active']])->where('is_goodwill',0)->count();
        $redeemCount = GiftToken::where([['bussiness_id',Auth::user()->id],['token_validaty','>=',Date('Y-m-d')],['status','inactive']])->whereNotNull('redeem_date')->where('is_goodwill',0)->count();

        return view("web.auth.coupon_overview",compact('activeToken','redeemToken','activeCount','redeemCount'));
    }

    public function couponLoadMore(Request $request){

        $start = $request->input('start');
        $status = $request->input('status');
        $filter = $request->input('filter');

        $query = GiftToken::with(['user' => function ($que) {
                 $que->select('id', 'full_name');
                 }])->where([['bussiness_id',Auth::user()->id],['token_validaty','>=',Date('Y-m-d')],['status',$status]])->where('is_goodwill',0);

        if($filter == 'amount'){
            $query->orderBy('token_amount','Desc');
        }else if($filter == 'newest'){
            $query->orderBy('id','Desc');
        }else{
            $query->orderBy('id','Desc');
        }

        $data = $query->skip($start)->take(10)->get();

        return response()->json([
            'data' => $data,
            'status' => $status,
            'next' => $start + count($data)
        ]);
    }

    public function couponDetail(Request $request)
    {
        if(!$request->token_code){
            return response()->json([
                'status' => 'error',
                'message' => 'Something wrong, please contact to administration.',
            ]);
        }

        $couponCode = trim($request->token_code);
        $auth_id = Auth::user()->id;
        $data = GiftToken::with(['user' => function ($query) {
            $query->select('id', 'full_name','address','avatar');
        }])->where([['token_code',$couponCode],['bussiness_id',$auth_id],])
        ->orderBy('id', 'desc')->first();

        if($data){
            return response()->json([
                'status' => 'success',
                'data' => $data,
            ]);
        }else {
            return response()->json([
                'status' => 'error',
                'message' => 'Something wrong, please contact to administration.',
            ]);
        }
    }

    public function goodwillCoupon(Request $request)
    {
        $query = GiftToken::where([['bussiness_id',Auth::user()->id],['status','active']])->where('is_goodwill',1);
        $rQuery =GiftToken::where([['bussiness_id',Auth::user()->id],['status','inactive']])->where('is_goodwill',1);
        if($request->filter){
            $filter = $request->filter;
            $status = $request->status;

            if($filter == 'amount'){
                $query->orderBy('token_amount','Desc');
                $rQuery->orderBy('token_amount','Desc');
            }else if($filter == 'newest'){
                $query->orderBy('id','Desc');
                $rQuery->orderBy('id','Desc');
            }else{
                $query->orderBy('id','Desc');
                $rQuery->orderBy('id','Desc');
            }
            $data = '';
            if($status == 'Active'){
                $data = $query->take(10)->get();
            }else if($status == 'Inactive'){
                $data = $rQuery->take(10)->get();
            }
            return response()->json([
                'data' => $data
            ]);
        }else{
            $query->orderBy('id','Desc');
            $rQuery->orderBy('id','Desc');
        }


        $activeToken = $query->take(10)->get();
        $redeemToken = $rQuery->take(10)->get();

        $activeCount = GiftToken::where([['bussiness_id',Auth::user()->id],['status','Active']])->where('is_goodwill',1)->count();
        $redeemCount = GiftToken::where([['bussiness_id',Auth::user()->id],['status','Inactive']])->where('is_goodwill',1)->count();

        return view("web.auth.goodwill_coupon",compact('activeToken','redeemToken','activeCount','redeemCount'));
    }

    public function goodwillLoadMore(Request $request){

        $start = $request->input('start');
        $status = $request->input('status');
        $filter = $request->input('filter');

        $query = GiftToken::with(['user' => function ($query) {
                 $query->select('id', 'full_name');
                 }])->where([['bussiness_id',Auth::user()->id],['status',$status]])->where('is_goodwill',1);

        if($filter == 'amount'){
            $query->orderBy('token_amount','Desc');
        }else if($filter == 'newest'){
            $query->orderBy('id','Desc');
        }else{
            $query->orderBy('id','Desc');
        }

        $data = $query->skip($start)->take(10)->get();

        return response()->json([
            'data' => $data,
            'status' => $status,
            'next' => $start + count($data)
        ]);
    }

    public function goodwillDetail(Request $request)
    {
        if(!$request->token_code){
            return response()->json([
                'status' => 'error',
                'message' => 'Something wrong, please contact to administration.',
            ]);
        }

        $couponCode = trim($request->token_code);
        $auth_id = Auth::user()->id;
        $data = GoodWillToken::with(['user' => function ($query) {
            $query->select('id', 'full_name','address','avatar');
        }])->where([['token_code',$couponCode],['bussiness_id',$auth_id],])
        ->orderBy('id', 'desc')->first();

        if($data){
            return response()->json([
                'status' => 'success',
                'data' => $data,
            ]);
        }else {
            return response()->json([
                'status' => 'error',
                'message' => 'Something wrong, please contact to administration.',
            ]);
        }
    }

    public function storeDetail()
    {
        $business_id = Auth::user()->id;
        $business = User::with(['plan' => function ($query) use ($business_id) {
                            $query->where('business_id',$business_id)
                            ->where('expiry_date','>=',date('Y-m-d'))
                            ->where('status','Active')->orderBy('id','Desc');
                    }])->where('id',$business_id)->where('status','active')->first();

        $totalRevenue = GiftToken::where('bussiness_id',$business_id)->sum('token_amount');
        $catList = Category::pluck('name','id');
        $countryCode = DB::table('country')->orderBy('phonecode','ASC')->pluck('phonecode','phonecode');
        $businessArr = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
        $busOperation = [];
        foreach($business->busOperation as $key => $busOpp){
            $busOperation[$busOpp->business_day][] = $busOpp->open_time;
            $busOperation[$busOpp->business_day][] = $busOpp->close_time;
        }
        $remaining = '';
        if(isset($business->plan->offer)){
            $remaining = $business->plan->total_offer;
            if(!empty($business->plan->offer)){
                $remaining = $business->plan->total_offer - count($business->plan->offer);
            }
        }

        return view("web.auth.store_detail",compact('business','catList','totalRevenue','businessArr','busOperation','countryCode','remaining'));
    }

    public function noPlan()
    {
        $plan = MyPlan::where('business_id',Auth::user()->id)->where('expiry_date','>=',date('Y-m-d'))->where('status','Active')->orderBy('id','Desc')->first();
        if(isset($plan->planList)){
            return view("web.auth.my_active_plan",compact('plan'));
        }
        return view("web.auth.no_plan");
    }

    public function myPlan()
    {
        $business = Auth::user();
        $plan = Plan::orderBy('id','ASC')->where('status','Active')->get();
        if(isset($business->plan->amount)){
           $planCount = Plan::where('total_amount','>',$business->plan->amount)->count();
           if(!$planCount){
            return redirect()->back()->withError('You have already purchased highest plan.');
           }
        }
        return view("web.auth.my_plan",compact('business','plan'));
    }

    public function myPlanSubmit(Request $request)
    {
        try{
            $data = $request->all();
            $exists = MyPlan::where('business_id',$data['business_id'])->where('expiry_date','>=',date('Y-m-d'))->where('status','Active')->orderBy('id','Desc')->first();
            if($exists){
                if($data['amount'] == $exists->amount){
                    return redirect()->route('my.plan')->withError("You have already purchased this plan.");
                }
            }

            $stripeCharge =  StripeTrait::createCharge($data);

            if($stripeCharge['charge_token']){
                $data['email'] = Auth::user()->email;
                //$data['business_id'] = $data['business_id'];
                $data['status'] = 'Active';
                $data['charge_token'] = $stripeCharge['charge_token'];
                $data['expiry_date'] = date('Y-m-d', strtotime(now(). ' + '.$data['valid_days'].' days'));

                if($exists){
                    MyPlan::find($exists->id)->update($data);
                    Mail::to($data['email'])->send(new UserPaymentMail($data,'exists'));
                    $notification = [
                        'target_id' => 1,
                        'user_id' => Auth::user()->id,
                        'message' => $data['business_name'].' has been upgraded '.$exists['plan'].' to '.$data['plan']. ' plan.',
                        'date' => date('Y-m-d'),
                        'time' => date('H:i a'),
                        'target_page' => 'admin/plans'
                    ];

                    Notification::create($notification);
                    return redirect()->route('my.offer')->withSuccess('Plan has been upgraded successfully.');
                }
                MyPlan::create($data);
                Mail::to($data['email'])->send(new UserPaymentMail($data));
                $notification = [
                    'target_id' => 1,
                    'user_id' => Auth::user()->id,
                    'message' => $data['business_name'].' has been purchased '.$data['plan']. ' plan.',
                    'date' => date('Y-m-d'),
                    'time' => date('H:i a'),
                    'target_page' => 'admin/plans'
                ];

                Notification::create($notification);

                return redirect()->route('my.offer')->withSuccess('Plan has been purchased successfully');
            }else {
                return redirect()->route('my.plan')->withSuccess('Something wrong, please contact to administration.');
            }
        }catch(Exception $e){
            return back()->withInput()->withError($e->getMessage());
        }
    }

    public function card($plan_name){

        $plan = Plan::where('name',$plan_name)->first();
        try{
            $business = Auth::user();
            $exists = MyPlan::where('business_id',$business->id)->where('expiry_date','>=',date('Y-m-d'))->where('status','Active')->orderBy('id','Desc')->first();
            if($exists){
                if($plan->total_amount == $exists->amount){
                    return redirect()->route('my.plan')->withError("You have been already purchased this plan.");
                }
            }

        }catch(Exception $e){
            return back()->withInput()->withError($e->getMessage());
        }
        return view("web.auth.card",compact('business','plan'));
    }

    public function myOffer()
    {
        $plan = MyPlan::where('business_id',Auth::user()->id)->where('expiry_date','>=',date('Y-m-d'))->where('status','Active')->orderBy('id','Desc')->first();
        if($plan){
            if(isset($plan->expiry_date) && !empty($plan->expiry_date)){
                $diffrence_days = round((strtotime($plan->expiry_date) - strtotime(date('Y-m-d')))/ (60 * 60 * 24));
            }
            $offers = Offers::where('bussiness_id',Auth::user()->id)->where('plan_id',$plan->id)->orderBy('id','Desc')->take(10)->get();
            $status = ['0'=>'Pending','1'=>'Approved','2'=>'Expired'];
            return view("web.auth.my_offer",compact('diffrence_days','offers','status'));
        }
        return view("web.auth.no_plan");
    }

    public function offerLoadMore(Request $request)
    {
        $start = $request->input('start');
        $data = Offers::where([['bussiness_id',Auth::user()->id]])->orderBy('id','Desc')->skip($start)->take(10)->get();

        return response()->json([
            'data' => $data,
            'next' => $start + count($data),
        ]);
    }

    public function createOffer()
    {
        $plan = MyPlan::where('business_id',Auth::user()->id)->where('expiry_date','>=',date('Y-m-d'))->where('status','Active')->orderBy('id','Desc')->first();
        if($plan){
            $remaining = $plan->total_offer;
            if(isset($plan->offer) && !empty($plan->offer)){
                $remaining = $plan->total_offer - count($plan->offer);
            }
            return view("web.auth.create_offer",compact('plan','remaining'));
        }
        return view("web.auth.no_plan");
    }

    public function offerCreation()
    {
        $plan = MyPlan::where('business_id',Auth::user()->id)->where('expiry_date','>=',date('Y-m-d'))->where('status','Active')->orderBy('id','Desc')->first();
        if($plan){
            $remaining = $plan->total_offer;
            if(isset($plan->offer) && !$plan->offer->isEmpty()){
                $remaining = $plan->total_offer - count($plan->offer);
            }
            return view("web.auth.offer_creation",compact('plan','remaining'));
        }
        return view("web.auth.no_plan");
    }

    public function offerCreationLast()
    {
        $plan = MyPlan::where('business_id',Auth::user()->id)->where('expiry_date','>=',date('Y-m-d'))->where('status','Active')->orderBy('id','Desc')->first();
        if($plan){
            $remaining = $plan->total_offer;
            if(isset($plan->offer) && !$plan->offer->isEmpty()){
                $remaining = $plan->total_offer - count($plan->offer);
            }
            if($remaining){
                return view("web.auth.offer_creation_last",compact('plan'));
            }
        }
        return view("web.auth.no_plan");

    }

    public function offerCreationSubmit(Request $request)
    {
        $request->validate([
            "text" => "required",
            "image" => "required|dimensions:max_width=350,max_height=350",
        ]);

       try{
            $data = $request->all();
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/offers/images');
                $image->move($destinationPath, $name);
                $data['image'] = $name;
            }
            $data['bussiness_id'] = Auth::user()->id;

            Offers::create($data);
            $notification = [
                'target_id' => 1,
                'user_id' => Auth::user()->id,
                'message' => Auth::user()->business_name.' has been created '.$data['text'].' offer ',
                'date' => date('Y-m-d'),
                'time' => date('H:i a'),
                'target_page' => 'admin/offers/'.Auth::user()->id
            ];

            Notification::create($notification);
            return redirect()->route('my.offer')->withSuccess('Offer has been created successfully');
        }catch(Exception $e){
            return back()->withInput()->withError($e->getMessage());
        }
    }

    public function offerCreationEdit($id)
    {
        $offer = Offers::where('id',$id)->first();
        return view("web.auth.offer_creation_edit",compact('offer'));
    }

    public function offerCreationUpdate(Request $request,$id)
    {

        $request->validate([
            "text" => "required",
            //"image" => "dimensions:max_width=350,max_height=350",
        ]);

       try{
            $data = $request->all();
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/offers/images');
                $image->move($destinationPath, $name);
                $data['image'] = $name;
            }

            Offers::find($id)->update($data);
            $notification = [
                'target_id' => 1,
                'user_id' => Auth::user()->id,
                'message' => Auth::user()->business_name.' has been updated '.$data['text'].' offer ',
                'date' => date('Y-m-d'),
                'time' => date('H:i a'),
                'target_page' => 'admin/offers/'.Auth::user()->id
            ];

            Notification::create($notification);
            return redirect()->route('my.offer')->withSuccess('Offer has been updated successfully');
        }catch(Exception $e){
            return back()->withInput()->withError($e->getMessage());
        }
    }

    public function offerCreationDelete(Request $request,$id)
    {
        $text = Offers::where('id',$id)->value('text');
        Offers::find($id)->delete();
        $notification = [
            'target_id' => 1,
            'user_id' => Auth::user()->id,
            'message' => Auth::user()->business_name.' has been deleted '.$text.' offer ',
            'date' => date('Y-m-d'),
            'time' => date('H:i a'),
            'target_page' => 'admin/offers/'.Auth::user()->id
        ];

        Notification::create($notification);
        return response()->json(['success' => true]);
        //return redirect()->back()->withSuccess('Offer has been deleted successfully');
    }

    public function offerCreationShow(){

    }

    public function notifications()
    {
        $notification = Notification::where('target_id',Auth::user()->id)->orderBy('id','DESC')->paginate(10);
        Notification::where('target_id',Auth::user()->id)->update(array('read_at'=>'1'));
        return view("web.auth.notification",compact('notification'));
    }

    public function notificationRead($id)
    {
        Notification::where('id',$id)->update(array('read_at'=>'1'));
        return response()->json(['success' => true]);
    }


    public function changePassword()
    {
        return view("web.auth.change_password");
    }

    public function updatePassword(Request $request)
    {
        $data = $request->all();
        $request->validate([
            "old_password" => "required",
            'password' => 'required|min:6',
            'repeat_password' => 'required|min:6|same:password',
        ]);

        try{
            if($request->ajax()){
                if(!Hash::check($request->old_password, auth()->user()->password)) {
                    return response()->json(['status' => 'error','message' => "Old Password Doesn't match!"]);
                }
                User::find(auth()->user()->id)->update([
                    "password" => Hash::make($request->password),
                ]);
                return response()->json(['status' => 'success','message' => "Password has been changed successfully!"]);
            }
            else{
                if(!Hash::check($request->old_password, auth()->user()->password)) {
                    if($request->ajax()){
                        return response()->json(['status' => 'error','message' => "Old Password Doesn't match!"]);
                    }
                    return back()->with("error", "Old Password Doesn't match!");
                }
                User::find(auth()->user()->id)->update([
                    "password" => Hash::make($request->password),
                ]);
                return back()->with("success", "Password has been changed successfully!");
            }
        }catch(Exception $e){
            if($request->ajax()){
                return response()->json(['status' => 'error','data' => $e]);
            }else{
                return back()->withInput()->withError($e->getMessage());
            }
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login.get')->withSuccess('Logout Successfully');
    }


}
