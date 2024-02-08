<?php

namespace App\Http\Controllers\Website\AthletesCoach;

use App\Http\Controllers\Controller;
use App\Models\{
    User,
    Video
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
            $UniqueViews = Video::where('user_id', $userID)->sum('video_veiw_count');
            return view('web.athletescoach.dashboard',compact('userID','UniqueViews'));
        }else{
            return redirect()->route('web.login');
        }
    }
}
