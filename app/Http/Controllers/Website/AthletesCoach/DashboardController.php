<?php

namespace App\Http\Controllers\Website\AthletesCoach;

use App\Http\Controllers\Controller;
use App\Models\{
    User,
    Video,
    Subscriptions,
    Plan,
    Transaction,
    VideoHistory
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    Auth,
    DB
};

class DashboardController extends Controller
{
    public function Dashboard(){
        try {
            if (Auth::check()) {
                $user = Auth::user();
                $userID = $user->id;


                $getUser = User::where('roles','!=','User')->where('user_status','1')->get();

                $incomeArray = array();
                $commistion = array();
                $totalcommsitionAmount = "0";

                foreach ($getUser as $key => $value) {
                    // Get unique views for the user
                    $videos = $value->videos()->withCount('videoHistory')
                        ->whereYear('created_at', now()->year)
                        ->whereMonth('created_at', now()->month)
                        ->get();
                    $uniqueViews = $videos->sum('video_history_count');
                
                    // Get total views for all videos
                    $totalViews = VideoHistory::whereMonth('created_at', now()->format('m'))->count();
                
                    // Get Total Income
                    $income = Transaction::where('status', 'active')
                        ->whereYear('created_at', now()->year)
                        ->whereMonth('created_at', now()->format('m'))
                        ->sum('amount');
                
                    // Calculate athlete's share if there are unique views
                    $videoRevenue = 0;
                    if ($uniqueViews != 0) {
                        $athleteShare = $uniqueViews / $totalViews;
                        $totalAthleteIncome = $income * 0.6;
                        $videoRevenue = $totalAthleteIncome * $athleteShare;
                        $videoRevenue = number_format($videoRevenue, 2);
                    }
                    $incomeArray[$value->id] = $videoRevenue;

                    
                    
                }

                foreach ($incomeArray as $incomeArraykey => $incomeArrayvalue) {
                    # code...
                }
                $ReffralByUser = User::where('referral_by',$value->id)->get();
                    
                    $ReffralByUserid = $ReffralByUser->pluck('id');
                    foreach ($ReffralByUser as $ReffralByUserkey => $ReffralByUservalue) {  
                        $commistionamount = $incomeArray[$ReffralByUservalue->id] * 0.1;
                        $totalcommsitionAmount += $commistionamount;
                    }

                    $commistion[$value->id] = $totalcommsitionAmount;
                echo "<pre>";
                print_r($commistion);
                die;
                // foreach ($getUser as $rrkey => $rrvalue) {
                //     $ReffralByUser = User::where('referral_by',$rrvalue->id)->get();
                //     $ReffralByUserid = $ReffralByUser->pluck('id');
                //     foreach ($ReffralByUserid as $ReffralByUserkey => $ReffralByUservalue) {  
                //         $commistionamount = $incomeArray[$ReffralByUservalue] * 0.1;
                //         $totalcommsitionAmount += $commistionamount;
                //     }
                // }
                // echo $totalcommsitionAmount;
                // die;
                // Return view with necessary data
                return view('web.athletescoach.dashboard', compact('userID', 'uniqueViews', 'videoRevenue','ReferralRevenue'));
            } else {
                return redirect()->route('web.login');
            }            
            
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }
    }
}
