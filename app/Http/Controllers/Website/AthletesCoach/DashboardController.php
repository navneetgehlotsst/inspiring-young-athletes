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
                $user = Auth::user();
                $userID = $user->id;
                $currentMonth = date('m');
                $currentYear = date('Y');
                $by = $request->query('by');
                $type = empty($by) ? 'Month' : 'Year';
            
                // Fetch video data and user income
                $videoQuery = Video::where('user_id', $userID);
                $userIncomeQuery = UserIncome::where('user_id', $userID);
            
                if (empty($by)) {
                    $videoQuery->with('videoHistoryMonth');
                    $userIncomeQuery->where('month', $currentMonth)->where('years', $currentYear);
                } else {
                    $videoQuery->with('videoHistoryYears');
                    $userIncomeQuery->where('years', $currentYear);
                }
            
                $uniqueViews = $videoQuery->count();
                $videoLists = $videoQuery->take(5)->orderBy('video_veiw_count', 'ASC')->get();
                $userIncome = $userIncomeQuery->first();
            
                // Prepare graph data
                $results = $videoQuery
                    ->leftJoin('video_history', function ($join) use ($currentMonth, $currentYear) {
                        if (empty($by)) {
                            $join->on('video.video_id', '=', 'video_history.video_id')
                                ->whereMonth('video_history.created_at', $currentMonth)
                                ->whereYear('video_history.created_at', $currentYear);
                        } else {
                            $join->on('video.video_id', '=', 'video_history.video_id')
                                ->whereYear('video_history.created_at', $currentYear);
                        }
                    })
                    ->selectRaw('IFNULL(DAY(video_history.created_at), 0) as day')
                    ->selectRaw('IFNULL(MONTH(video_history.created_at), 0) as month')
                    ->selectRaw('COUNT(video_history.id) as count')
                    ->groupByRaw('IFNULL(DAY(video_history.created_at), 0)')
                    ->groupByRaw('IFNULL(MONTH(video_history.created_at), 0)')
                    ->orderByRaw('IFNULL(DAY(video_history.created_at), 0)')
                    ->orderByRaw('IFNULL(MONTH(video_history.created_at), 0)')
                    ->get();
            
                $graphData = [];
                foreach ($results as $result) {
                    $graphData[$result->day ?? $result->month] = $result->count;
                }
            
                return view('web.athletescoach.dashboard', compact('userID', 'userIncome', 'uniqueViews', 'videoLists', 'graphData', 'type'));
            } else {
                return redirect()->route('web.login');
            }
            
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }
    }
}
