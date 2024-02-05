<?php

namespace App\Http\Controllers\Website\AthletesCoach;

use App\Http\Controllers\Controller;
use App\Models\{
    Category,
    Role,
    User
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

class RegisterController extends Controller
{
    public function random_strings($length_of_string) 
    { 
        $str_result = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz'; 
        return substr(str_shuffle($str_result), 0, $length_of_string); 
    }
    // Register
    public function Register(){
        $getcategory = Category::where('category_status','1')->get();
        $getrole = Role::latest()->take(2)->get();
        return view('web.athletescoach.register',compact('getcategory','getrole'));
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
        ];


        Mail::to($Useremail)->send(new VerifyUserEmail($datauser, $code));
        $request->session()->put('user', $datauser);

        // return view('web.athletescoach.otp-verified-athletes-and-coach',compact('Useremail'));
        return redirect()->route('web.athletes.coach.VerificationOtp')->with('success', 'Please enter OTP to complete your registration.');

    }

    public function verification_otp(){
        $user = Session::get('user');
        $email = $user['email'];
        return view('web.athletescoach.otp-verified-athletes-and-coach',compact('email','user'));
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
                    $id = User::insertGetId($datauser);
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
            'futureDate' => $futureDate
        ];
        Mail::to($email)->send(new VerifyUserEmail($datauser, $code));
        $request->session()->put('user', $datauser);
        return redirect()->back()->with('success', 'OTP sent again on your mail.');

    }

    public function verificationSuccess(){
        $user = Auth::user();
        return view('web.athletescoach.successfull-athletes-and-coach');
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
        $UserDetail = Auth::user();
        $userID = $UserDetail->id;


        $updateUserData = [
            'name' => $input['name'],
            'email' => $input['email'],
            'category' => $input['category'],
            'phone' => $input['number'],
            'linkedin' => $input['linkedin'],
            'tiktok' => $input['tiktok'],
            'instagram' => $input['instagram'],
            'facebook' => $input['facebook'],
        ];
        
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
            if(!empty($UserDetail->profile)){
                $imagePath = public_path($UserDetail->profile);
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
        return back()->with("success", "Password changed successfully!");

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
            $url = $baseUrl.'/athletes-coach/register?ref='.$userreferral_token;
            return view('web.athletescoach.referralandearn',compact('userID','url'));
        }else{
            return redirect('')->route('web.login');
        }
    }

    public function referralAndEarnSend(Request $request){
        $UserDetail = Auth::user();
        $senderemail = $UserDetail->email; 
        $url = $request->url;
        $code = $request->code;
        $referralEmail = $request->referralEmail;

        $mail = Mail::to($referralEmail)->send(new RefralEmail($referralEmail, $code,$senderemail,$url));
        return redirect()->back()->with('success', 'Referral Send Successfully.');
    }


}
