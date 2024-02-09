<?php

namespace App\Http\Controllers\Website\User;

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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    Auth,
    Hash,
    Session,
    Storage
};
use App\Mail\VerifyUserEmail;
use Laravel\Cashier\Cashier;

class UserRegisterController extends Controller
{
    // Register
    public function Register(){
        return view('web.user.register');
    }

    // Register Post
    public function RegisterSubmit(Request $request){

        $validatedData = $request->validate([
            'email' => 'required|email|unique:users',
            'name' => 'required|max:100',
            'phone' => 'required|numeric|digits_between:8,10|unique:users',
            'password' => 'required',
        ]);

        // $id = User::insertGetId($datauser);

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
            'roles' => 'User',
            'otp' => $code,
            'futureDate' => $futureDate
        ];


        Mail::to($Useremail)->send(new VerifyUserEmail($datauser, $code));
        $request->session()->put('user', $datauser);

        // return view('web.athletescoach.otp-verified-athletes-and-coach',compact('Useremail'));
        return redirect()->route('web.user.VerificationOtp')->with('success', 'Please enter OTP to complete your registration.');

    }

    public function verification_otp(){
        $user = Session::get('user');
        $email = $user['email'];
        return view('web.user.otp-verified',compact('email','user'));
    }

    public function verifyOtp(Request $request){
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
                        'roles' => 'User',
                        'email_verified_at' => $date,
                    ];
                    $user = User::create($datauser);
                    $stripeCustomer = $user->createAsStripeCustomer();
                    $user = User::find($user->id);
                    $user->stripe_id = $stripeCustomer->id;
                    $user->save();
                    session()->forget('user');
                    $credentials = [
                        'email' => $user['email'],
                        'password' => $user['temppassword'],
                    ];
                    Auth::attempt($credentials);
                    return redirect()->route('web.user.verificationSuccess');
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
            'otp' => $code,
            'futureDate' => $futureDate
        ];
        Mail::to($email)->send(new VerifyUserEmail($datauser, $code));
        $request->session()->put('user', $datauser);
        return redirect()->back()->with('success', 'OTP sent again on your mail.');

    }

    public function verificationSuccess(){
        $user = Auth::user();
        return view('web.user.successfull-user');
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


    public function edit_profile(){
        if (Auth::check()){
            $UserDetail = Auth::user();
            $userID = $UserDetail->id;
            return view('web.profile',compact('userID','UserDetail'));
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
            'phone' => $input['phone'],
        ];
        
        User::where('id', $userID)->update($updateUserData);

        return redirect()->back()->with('success', 'Profile Update Successfully.');
    }

    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect()->route('web.login')
            ->with('success', 'Logout Successfully.');
    }
}
