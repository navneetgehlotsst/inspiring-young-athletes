<?php

namespace App\Http\Controllers\Website\AthletesCoach;

use App\Http\Controllers\Controller;
use App\Models\{
    User,
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    Auth,
};

class DashboardController extends Controller
{
    public function Dashboard(){
        if (Auth::check()){
            $UserDetail = Auth::user();
            $userID = $UserDetail->id;
            return view('web.athletescoach.dashboard',compact('userID'));
        }else{
            return redirect()->route('web.login');
        }
    }
}
