<?php

namespace App\Http\Controllers\Website\AthletesCoach;

use App\Http\Controllers\Controller;
use App\Models\{
    Category,
    Role,
    User,
    ReferralHistory,
    Subscriptions,
    SubscriptionsItem,
    Plan
};
use Exception;
use DB;
use Mail;
use File;
use URL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    Auth,
    Hash,
    Session,
    Storage
};
use App\Mail\VerifyUserEmail;
use App\Mail\RefralEmail;
use Laravel\Cashier\Subscription;
use Laravel\Cashier\SubscriptionItem;
use Laravel\Cashier\Cashier;
use Laravel\Cashier\PaymentMethod;

class RegisterController extends Controller
{
    public function random_strings($length_of_string) 
    { 
        $str_result = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz'; 
        return substr(str_shuffle($str_result), 0, $length_of_string); 
    }
    // Register
    public function Register(Request $request){
        if(!empty($request->ref)){  
            $ref = $request->ref;
            $getRefByDetail = ReferralHistory::where('referralhistory.id', $ref)
            ->join('users', 'referralhistory.referral_by', '=', 'users.id')
            ->select('referralhistory.referral_to','referralhistory.id', 'users.referral_token')
            ->first();
        }else{
            $getRefByDetail = "";
        }
        $getcategory = Category::where('category_status','1')->get();
        $getrole = Role::latest()->take(2)->get();
        return view('web.athletescoach.register',compact('getcategory','getrole','getRefByDetail'));
    }

    // Register Post
    public function RegisterSubmit(Request $request){

        $validatedData = $request->validate([
            'email' => 'required|email|unique:users',
            'name' => 'required|max:100',
            'phone' => 'required|numeric|digits_between:8,10|unique:users',
            'role' => 'required',
            'category' => 'required',
            'password' => 'required',
        ]);

        // $id = User::insertGetId($datauser);
        $code = $request->code;
        if(!empty($code)){
            $checkreffralcode = User::where('referral_token',$code)->first();
            if(empty($checkreffralcode)){
                return redirect()->back()->withInput()->with('error', 'Enter Valid Referral Code.');
            }
            $referral_by = $checkreffralcode->id;
        }else{
            $referral_by = "0";
        }
        $Useremail = $request->email;
        $code = 1234; //rand(1000,9999);
        $date = date('Y-m-d H:i:s');
        $currentDate = strtotime($date);
        $futureDate = $currentDate+(60*5);

        $datauser = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'temppassword' => $request->password,
            'phone' => $request->phone,
            'roles' => $request->role,
            'category' => $request->category,
            'otp' => $code,
            'futureDate' => $futureDate,
            'referral_by' => $referral_by,
            'referral_history' =>$request->refid,
        ];


        Mail::to($Useremail)->send(new VerifyUserEmail($datauser, $code));
        $request->session()->put('user', $datauser);

        // return view('web.athletescoach.otp-verified-athletes-and-coach',compact('Useremail'));
        return redirect()->route('web.athletes.coach.VerificationOtp')->with('success', 'Please enter OTP to complete your registration.');

    }

    public function verification_otp(){
        $user = Session::get('user');
        if(!empty($user)){
            $email = $user['email'];
            return view('web.athletescoach.otp-verified-athletes-and-coach',compact('email','user'));
        }else{
            return redirect()->route('web.index');
        }
    }

    public function verifyOtp(Request $request){
            $refral_token = $this->random_strings('10');
            $user = Session::get('user');
            $email = $user['email'];
            $otp = $request->otp1.$request->otp2.$request->otp3.$request->otp4;
            $date = date('Y-m-d H:i:s');
            $currentTime = strtotime($date);
            if($user['otp'] == $otp){
                if($currentTime < $user['futureDate']){

                    $datauser = [
                        'name' => $user['name'],
                        'email' => $user['email'],
                        'password' => $user['password'],
                        'phone' => $user['phone'],
                        'roles' => $user['roles'],
                        'category' => $user['category'],
                        'email_verified_at' => $date,
                        'referral_token' => $refral_token,
                        'referral_by' => $user['referral_by'],
                        
                    ];
                    $userref = $user['referral_history'];
                    $id = User::insertGetId($datauser);
                    if($userref != 0){
                        
                        $checkreffralcode = ReferralHistory::where('referral_to',$user['email'])->where('referral_by',$user['referral_by'])->first();
                        if($checkreffralcode){
                                $updateUserData = [
                                    'status' => 'accepted',
                                ];
                                ReferralHistory::where('id', $checkreffralcode->id)->update($updateUserData);
                        }else{
                            $datauser = [
                                'referral_by' => $user['referral_by'],
                                'referral_to' => $user['email'],
                                'status' => 'accepted',
                            ];
                            $id = ReferralHistory::insertGetId($datauser);
                        }
                    }else{
                        if($user['referral_by'] != "0"){
                            $datauser = [
                                'referral_by' => $user['referral_by'],
                                'referral_to' => $user['email'],
                                'status' => 'accepted',
                            ];
                            $id = ReferralHistory::insertGetId($datauser);
                        }
                    }
                    session()->forget('user');
                    $credentials = [
                        'email' => $user['email'],
                        'password' => $user['temppassword'],
                    ];
                    Auth::attempt($credentials);
                    return redirect()->route('web.athletes.coach.verificationSuccess');
                }else{
                    return redirect()->back()->with('error', 'Otp expired..!');
                }
            }else{
                return redirect()->back()->with('error', 'Please enter valid Otp.');
            }
    }

    public function reSendOtp(Request $request){
        $user = Session::get('user');
        if(!empty($user)){
            $email = $user['email'];
            $code = 1234; //rand(1000,9999);
            $date = date('Y-m-d H:i:s');
            $currentDate = strtotime($date);
            $futureDate = $currentDate+(60*5);
            $datauser = [
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => $user['password'],
                'temppassword' => $user['temppassword'],
                'phone' => $user['phone'],
                'roles' => $user['roles'],
                'category' => $user['category'],
                'otp' => $code,
                'futureDate' => $futureDate,
                'referral_by' => $user['referral_by'],
                'referral_history' => $user['referral_history'],
            ];
            Mail::to($email)->send(new VerifyUserEmail($datauser, $code));
            $request->session()->put('user', $datauser);
            return redirect()->back()->with('success', 'OTP sent again on your mail.');
        }else{
            return redirect()->route('web.index');
        }

    }

    public function verificationSuccess(){
        $user = Auth::user();
        return view('web.athletescoach.successfull-athletes-and-coach',compact('user'));
    }

    public function GetEditProfile(){
        if (Auth::check()){
            $UserDetail = Auth::user();
            $userID = $UserDetail->id;
            $getcategory = Category::where('category_status','1')->get();
            return view('web.athletescoach.editprofile',compact('userID','getcategory'));
        }else{
            return redirect('')->route('web.login');
        }
    }

    public function profileupdate(Request $request){
        $input = $request->all();
        $userDetail = Auth::user();
        $userID = $userDetail->id;

        $updateUserData = [
            'name' => $input['name'],
            'email' => $input['email'],
            'phone' => $input['number'],
        ];

        if(auth()->user()->roles != "User"){
            $updateUserData['category'] = $input['category'];
            $updateUserData['linkedin'] = $input['linkedin'];
            $updateUserData['tiktok'] = $input['tiktok'];
            $updateUserData['instagram'] = $input['instagram'];
            $updateUserData['facebook'] = $input['facebook'];
        }

        if($request->has('profileimg')){
            $profileimg = $request->file('profileimg');
            $profileimgName = time() . '.' . $profileimg->getClientOriginalExtension();
            $path = 'storage/user/'.$userID.'/profile';
            if(!File::exists($path)) {
                File::makeDirectory($path, $mode = 0777, true, true);
            }
            $profileimg->move(public_path($path), $profileimgName);
            $profileimgNamepath = $path.'/'.$profileimgName;
            $updateUserData['profile'] = $profileimgNamepath;
            if(!empty($userDetail->profile)){
                $imagePath = public_path($userDetail->profile);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        }

        User::where('id', $userID)->update($updateUserData);

        return redirect()->back()->with('success', 'Profile Update Successfully.');

    }

    public function ChangePassword(){
        if (Auth::check()){
            $UserDetail = Auth::user();
            $userID = $UserDetail->id;
            return view('web.athletescoach.changepassword',compact('userID'));
        }else{
            return redirect('')->route('web.login');
        }
    }

    public function passwordupdate(Request $request){
        //Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

         #Match The Old Password
         if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with("error", "Old Password Doesn't match!");
        }

         #Update the new Password
         User::whereId(auth()->user()->id)->update([
            "password" => Hash::make($request->new_password),
        ]);
        return back()->with("success", "Your password has updated successfully.Please log in!");

    }

    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect()->route('web.login')
            ->with('success', 'Logout Successfully.');
    }

    public function referralAndEarn(){
        if (Auth::check()){
            $baseUrl = url('/');
            $UserDetail = Auth::user();
            $userID = $UserDetail->id;
            $userreferral_token = $UserDetail->referral_token;
            $getrefhistory = ReferralHistory::where('referral_by',$userID)->get();
            $url = $baseUrl.'/athletes-coach/register?ref='.$userreferral_token;
            return view('web.athletescoach.referralandearn',compact('userID','url','getrefhistory'));
        }else{
            return redirect('')->route('web.login');
        }
    }

    public function referralAndEarnSend(Request $request){
        $baseUrl = url('/');
        $UserDetail = Auth::user();
        $senderemail = $UserDetail->email; 
        $posturl = $request->url;
        $code = $request->code;
        $referralEmail = $request->referralEmail;

        $datauser = [
            'referral_by' => $UserDetail->id,
            'referral_to' => $referralEmail,
        ];
        $id = ReferralHistory::insertGetId($datauser);
        $url = $baseUrl.'/athletes-coach/register?ref='.$id;

        $mail = Mail::to($referralEmail)->send(new RefralEmail($referralEmail, $code,$senderemail,$url));
        return redirect()->back()->with('success', 'Referal email sent successfully.');
    }

    public function MySubcription(){
        if (Auth::check()){
            $result = Subscriptions::where('user_id',Auth::user()->id)
                  ->join('subscription_items', 'subscriptions.id', '=', 'subscription_items.subscription_id')
                  ->first();
            $resulplan = Plan::where('status','1')->first();
            return view('web.athletescoach.my-subcription', compact('resulplan','result'));
        }else{
            return redirect('')->route('web.login');
        }
    }

    public function cancel_subcription(){
        $user = Auth::user();
        $subscription = Subscription::query()->active()->where('user_id',$user->id)->first();
        if($subscription){ 
            $subid = $subscription->name??'';
            $sub = $subscription->cancel();
            return redirect()->back()->with('success', 'Membership Cancel Successfully');
        }else{
            return back()->withInput()->withError('error','Subscription Not Valid');   
        }
    }


    public function resume_subcription(){
        $user = Auth::user();
        $subscription = Subscription::query()->active()->where('user_id',$user->id)->first();
        
        if($subscription){    
            $subid = $subscription->name ?? '';
            $sub = $subscription->resume();
            return redirect()->back()->with('success', 'Membership Resume Successfully');
        }else{
            
             return back()->withInput()->withError('error','Subscription Not Valid');
                 //return redirect()->back()->with('status', 'Subscription Not Valid');   
        }

       

    }



}
