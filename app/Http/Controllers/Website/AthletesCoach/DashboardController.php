<?php

namespace App\Http\Controllers\Website\AthletesCoach;

use App\Http\Controllers\Controller;
use App\Models\{
    User,
    Video,
    Subscriptions,
    Plan,
    Transaction,
    VideoHistory,
    UserIncome
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    Auth,
    DB
};
use Carbon\Carbon;
class DashboardController extends Controller
{
    public function Dashboard(Request $request){
        try {
            if (Auth::check()) {
                $by = $request->query('by');
                $user = Auth::user();
                $userID = $user->id;
                $currentMonth = date('m');
                $currentYear = date('Y');

                // Get the previous month and year
                $previousMonth = date('m', strtotime('-1 month'));
                $previousYear = date('Y', strtotime('-1 month'));
                $monthlyActiveUsers = [];

                if(empty($by)){
                    $uniqueViews = Video::with('videoHistoryMonth')
                    ->where('video.user_id', $userID)
                    ->count();            
                    $videoLists = Video::where('user_id', $userID)->take(5)->orderBy('video_veiw_count', 'ASC')->get();
                    $userIncome = UserIncome::where('user_id', $userID)->where('month', $currentMonth)->where('years', $currentYear)->first();

                    $results = Video::where('video.user_id', $userID)
                    ->leftJoin('video_history', function ($join) use ($currentMonth, $currentYear) {
                        $join->on('video.video_id', '=', 'video_history.video_id')
                            ->where(DB::raw("MONTH(video_history.created_at)"), '=', $currentMonth)
                            ->where(DB::raw("YEAR(video_history.created_at)"), '=', $currentYear);
                    })
                    ->select(DB::raw('DAY(video_history.created_at) as day'), DB::raw('COUNT(video_history.id) as count'))
                    ->groupBy(DB::raw('DAY(video_history.created_at)'))
                    ->orderBy(DB::raw('DAY(video_history.created_at)'))
                    ->get();
                    $filledResults = [];
                    foreach (range(1, 31) as $day) {
                        $found = false;
                        foreach ($results as $result) {
                            if ($result->day == $day) {
                                $filledResults[] = $result;
                                $found = true;
                                break;
                            }
                        }
                        if (!$found) {
                            $filledResults[] = (object) ['day' => $day, 'count' => 0];
                        }
                    }
                    if(!empty($filledResults)){
                        foreach ($filledResults as $key => $graphresult) {
                            $date[] = $graphresult->day.'/'.$currentMonth.'/'.$currentYear;
                            $count[] = $graphresult->count;
                        }
                    }
                    $type = "Month";
                    $by = "";
                }else{
                    $uniqueViews = Video::with('videoHistoryYears')
                    ->where('video.user_id', $userID)
                    ->count();            
                    $videoLists = Video::where('user_id', $userID)->take(5)->orderBy('video_veiw_count', 'ASC')->get();
                    $userIncome = UserIncome::where('user_id', $userID)->where('years', $currentYear)->first();
                    $results = Video::where('video.user_id', $userID)
                    ->leftJoin('video_history', function ($join) use ($currentYear) {
                        $join->on('video.video_id', '=', 'video_history.video_id')
                            ->where(DB::raw("YEAR(video_history.created_at)"), '=', $currentYear);
                    })
                    ->select(DB::raw('MONTH(video_history.created_at) as month'), DB::raw('COUNT(video_history.id) as count'))
                    ->groupBy(DB::raw('MONTH(video_history.created_at)'))
                    ->orderBy(DB::raw('MONTH(video_history.created_at)'))
                    ->get();
                    $filledResults = [];
                    foreach (range(1, 12) as $month) {
                        $found = false;
                        foreach ($results as $result) {
                            if ($result->month == $month) {
                                $filledResults[] = $result;
                                $found = true;
                                break;
                            }
                        }
                        if (!$found) {
                            $filledResults[] = (object) ['month' => $month, 'count' => 0];
                        }
                    }
                    if(!empty($filledResults)){
                        foreach ($filledResults as $key => $graphresult) {
                            $date[] = $graphresult->month;
                            $count[] = $graphresult->count;
                        }
                    }
                    $type = "Year";
                }
                return view('web.athletescoach.dashboard', compact('userID','userIncome','uniqueViews','videoLists','date','count','type','by'));
            }else {
                return redirect()->route('web.login');
            }                      
            
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }

    }
}
