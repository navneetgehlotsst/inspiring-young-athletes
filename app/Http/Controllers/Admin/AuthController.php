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
        // Validate request
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check if user exists
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Invalid credentials..!');
        }

        // Attempt authentication
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication successful
            if ($user->roles == 'Admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->back()->with('error', 'Invalid credentials..!');
            }
        }

        // Authentication failed
        return redirect()->back()->with('error', 'Invalid credentials..!');

    }


    // Login page
    public function forgotpassword(){
        return view('admin.forgotPassword');
    }


    // Dashboard
    public function dashboard()
    {
        if (Auth::check()) {
            return view('admin.dashboard');
        }else {
            return redirect()->route('admin.login');
        }    
    }


    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

}
