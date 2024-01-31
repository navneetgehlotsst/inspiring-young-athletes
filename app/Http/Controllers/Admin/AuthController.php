<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Helper, Mail, Str;
use DB,URL,Redirect;
use Carbon\Carbon;

use Illuminate\Support\Facades\{
    Auth,
    Hash,
    Session,
    Storage
};

use App\Models\{
    Category,
    Role,
    User,
    Video,
    VideoHistory
};

class AuthController extends Controller
{
    // Login page
    public function Login(){
        return view('admin.login');
    }

    // Login POST
    public function LoginPost(Request $request){
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $userCheck = User::where('email',$request->email)->first();
        if(empty($userCheck)){
            return redirect()->back()->with('error', 'Invalid credentials..!');
        }else{
            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->route('admin.dashboard');
            }else{
                return redirect()->back()->with('error', 'Invalid credentials..!');
            }
        }
    }


    // Login page
    public function forgotpassword(){
        return view('admin.forgotPassword');
    }


    // Dashboard
    public function dashboard()
    {
        return view('admin.dashboard');
    }


    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

}
