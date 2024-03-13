<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Plan;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Mail, DB, Hash, Validator, Session, File;

class AuthController extends Controller
{
    public function admin()
    {
        if(Auth::user()) {
            $user = Auth::user();
            if($user->role == "admin") {
                return redirect()->route('admin.dashboard');
            }else{
                return back()->with("error","Oops, insufficient access. Please contact administration for assistance.");
            }
        }else{
            return redirect()->route('admin.login');
        }
    }

    public function adminDashboard()
    {
        $userCount = User::where('role','user')->count();
        $businessCount = User::where('role','business')->count();
        $planCount = Plan::count();
        return view("admin.dashboard.index",compact('userCount','businessCount','planCount'));
    }

    public function index()
    {
        return view("admin.auth.login");
    }

    public function registration()
    {
        return view("admin.auth.registration");
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            "email" => "required",
            "password" => "required",
        ]);

        $user = User::where('role','admin')->where('email',$request->email)->first();
        if($user){
            $credentials = $request->only("email", "password");
            if(Auth::attempt($credentials)) {
                return redirect()->route("admin.dashboard")->with("success", "Welcome to your dashboard.");
            }
            return redirect()->route('admin.login')->with("error","Oopes! You have entered invalid credentials");
        }else{
            return redirect()->route('admin.login')->with("error","Oopes! You have entered invalid credentials");
        }
        
    }

    public function postRegistration(Request $request)
    {
        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required|min:6",
        ]);

        $data = $request->all();
        $check = $this->create($data);

        return redirect()->route('admin.dashboard')->with("success","Great! You have Successfully loggedin");
    }

    public function create(array $data)
    {
        return User::create([
            "name" => $data["name"],
            "email" => $data["email"],
            "password" => Hash::make($data["password"]),
        ]);
    }

    public function showForgetPasswordForm()
    {
        return view("admin.auth.forgot-password");
    }

    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            "email" => "required|email|exists:users",
        ]);

        $token = Str::random(64);

        DB::table("password_resets")->insert([
            "email" => $request->email,
            "token" => $token,
            "created_at" => Carbon::now(),
        ]);

        $new_link_token = url("admin/reset-password/" . $token);
        Mail::send("admin.email.forgot-password",["token" => $new_link_token, "email" => $request->email],
            function ($message) use ($request) {
                $message->to($request->email);
                $message->subject("Reset Password");
            }
        );

        return redirect()->route("admin.login")->with("success","We have e-mailed your password reset link!");
    }

    public function showResetPasswordForm($token)
    {
        $user = DB::table("password_resets")->where("token", $token)->first();
        $email = $user->email;
        return view("admin.auth.reset-password", ["token" => $token,"email" => $email,]);
    }

    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            "email" => "required|email|exists:users",
            "password" => "required|string|min:6|confirmed",
            "password_confirmation" => "required",
        ]);

        $updatePassword = DB::table("password_resets")->where(["email" => $request->email,"token" => $request->token])->first();

        if (!$updatePassword) {
            return back()->withInput()->with("error", "Invalid token!");
        }

        $user = User::where("email", $request->email)->update(["password" => Hash::make($request->password)]);

        DB::table("password_resets")->where(["email" => $request->email])->delete();

        return redirect()->route("admin.login")->with("success","Your password has been changed successfully!");
    }

    public function changePassword()
    {
        return view("admin.auth.change-password");
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            "old_password" => "required",
            "new_password" => "required|confirmed",
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

    

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route("admin.login");
    }

    public function userProfile()
    {
        $user = Auth::user();
        return view("admin.auth.profile", compact("user"));
    }

    public function updateuserProfile(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();
        $validator = Validator::make($data,[
            "first_name" => "required",
            "last_name" => "required",
            "phone" => "required|min:9|unique:users,phone," .$user->id,
            "email" => "required|email|unique:users,email," . $user->id,
            "avatar" => "sometimes|image|mimes:jpeg,jpg,png|max:2000",
        ]);
        if($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
        }
        try {
            if($request->file("avatar")) {
                $file = $request->file("avatar");
                $filename = time() . $file->getClientOriginalName();
                $folder = "uploads/user/";
                $path = public_path($folder);
                if (!File::exists($path)) {
                    File::makeDirectory($path, $mode = 0777, true, true);
                }
                $file->move($path, $filename);
                $user->avatar = $folder . $filename;
            }
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->full_name = $request->first_name . " " . $request->last_name;
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->save();
            return redirect()->back()->with("success", "Profile update successfully!");
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
}
