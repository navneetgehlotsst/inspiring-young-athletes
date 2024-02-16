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
                $namecurrentMonth = date('M');
                $currentYear = date('Y');

                // Get the previous month and year
                $previousMonth = date('m', strtotime('-1 month'));
                $namepreviousMonth = date('M', strtotime('-1 month'));
                $previousYear = date('Y', strtotime('-1 month'));
                $monthlyActiveUsers = [];

                if(empty($by)){
                    // Fetch unique views
                    $uniqueViews = Video::where('video.user_id', $userID)->join('video_history', 'video.video_id', '=', 'video_history.video_id')->count();

                    // Fetch video lists
                    $videoLists = Video::where('user_id', $userID)
                        ->orderBy('video_veiw_count')
                        ->take(5)
                        ->get(['video_id','video_title', 'user_id', 'video_veiw_count']); // Select only necessary columns
                   

                    // Fetch user income
                    $userIncome = UserIncome::where('user_id', $userID)
                        ->where('month', $currentMonth)
                        ->where('years', $currentYear)
                        ->first();

                    // Fetch video history results
                    $results = Video::where('video.user_id', $userID)
                        ->leftJoin('video_history', function ($join) use ($currentMonth, $currentYear) {
                            $join->on('video.video_id', '=', 'video_history.video_id')
                                ->whereMonth('video_history.created_at', $currentMonth)
                                ->whereYear('video_history.created_at', $currentYear);
                        })
                        ->selectRaw('DAY(video_history.created_at) as day, COUNT(video_history.id) as count')
                        ->groupByRaw('DAY(video_history.created_at)')
                        ->orderByRaw('DAY(video_history.created_at)')
                        ->get();

                    // Fill missing days in results
                    $filledResults = collect(range(1, 31))->map(function ($day) use ($results) {
                        $foundResult = $results->firstWhere('day', $day);
                        return $foundResult ?: (object)['day' => $day, 'count' => 0];
                    });

                    // Extract date and count for graph
                    $date = $filledResults->map(function ($graphResult) use ($namecurrentMonth, $currentYear) {
                        return $graphResult->day.'/'.$namecurrentMonth.'/'.$currentYear;
                    });

                    $count = $filledResults->pluck('count')->all();

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
                    ->select(DB::raw('MONTHNAME(video_history.created_at) as month'), DB::raw('COUNT(video_history.id) as count'))
                    ->groupBy(DB::raw('MONTH(video_history.created_at)'))
                    ->orderBy(DB::raw('MONTH(video_history.created_at)'))
                    ->get();
                    $filledResults = [];
                    $month_names = array("January","February","March","April","May","June","July","August","September","October","November","December");
                    foreach ($month_names as $month) {
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

    public function RevenueHistory(Request $request){
        try {
            if (Auth::check()) {
                $user = Auth::user();
                $userID = $user->id;
                $userIncomes = UserIncome::where('user_id', $userID)->get();
                return view('web.athletescoach.revinuehistory', compact('userID','userIncomes'));
            }else {
                return redirect()->route('web.login');
            } 
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }
    }
}
