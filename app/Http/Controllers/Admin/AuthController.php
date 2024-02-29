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
    VideoHistory,
    Subscriptions,
    Transaction,
    UserIncome
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


    // Forgot Password page
    public function forgotpassword(){
        return view('admin.forgotPassword');
    }

    
    // Edit Profile Page
    public function editProfile(){
        $user = Auth::user();
        if (Auth::check()) {
            return view('admin.profile', compact('user'));
        }else {
            return redirect()->route('admin.login');
        }   
    }


    // Dashboard
    public function dashboard()
    {
        try {
            if (Auth::check()) {
                $currentMonth = date('m');
                $namecurrentMonth = date('M');
                $namepreviousMonth = date('M', strtotime('-1 month'));
                $previousMonth = date('m', strtotime('-1 month'));
                $currentYear = date('Y');
                $previousYear = date('Y', strtotime('-1 month'));
    
                // 1. Get total user count directly from the database
                $totalUsersCount = User::where('user_status', '1')->where('roles','!=', 'Admin')->count();
    
                // Initialize counters
                $userCount = 0;
                $coachesCount = 0;
                $athletesCount = 0;
    
                // Assuming the roles are consistent and well-defined
                // 2. Loop through user roles to count each type
                foreach (User::where('user_status', '1')->where('roles','!=', 'Admin')->get() as $user) {
                    if ($user->roles === "User") {
                        $userCount++;
                    } elseif ($user->roles === "Athletes") {
                        $athletesCount++;
                    } else {
                        $coachesCount++;
                    }
                }
    
                // 3. Optimize calculation by using a single query
                $subscriptionAmount = Transaction::where('transaction_type', 'subscription')
                    ->whereMonth('created_at', $currentMonth)
                    ->whereMonth('created_at', $currentMonth)
                    ->sum('amount');
    
                $totalAthleteIncome = $subscriptionAmount * env('ATHLETES_COACH');
    
                $referralRevenue = UserIncome::where('month', $namecurrentMonth)->sum('referralrevenue');
    
                // 4. Perform necessary calculations
                $adminIncome = $subscriptionAmount - $totalAthleteIncome - $referralRevenue;

                //5. Total Video Count
                $totalVideoCount = Video::count();

                // Initialize counters
                $approvedCount = 0;
                $rejectedCount = 0;
                $pendingCount = 0;
                $paidCount = 0;
                $freeCount = 0;
    
                // Assuming the roles are consistent and well-defined
                // 6. Loop through Video to count each type
                $video = Video::get();
                
                foreach (Video::get() as $video) {
                    if ($video->video_status === "0") {
                        $pendingCount++;
                    } elseif ($video->video_status === "1") {
                        $approvedCount++;
                    } else {
                        $rejectedCount++;
                    }

                    if ($video->video_type == "1") {
                        $paidCount++;
                    } elseif ($video->video_type == "2") {
                        $freeCount++;
                    }else{

                    }
                }


                // 7. user Count graph
                $userCounts = User::select(DB::raw('MONTHNAME(created_at) as month, roles, COUNT(*) as count'))
                ->where('roles', '!=', 'Admin')
                ->groupBy('month', 'roles')
                ->orderBy('month', 'desc')
                ->orderBy('roles')
                ->get();

                $userDataCount = [];
                $month_names = ["January","February","March","April","May","June","July","August","September","October","November","December"];

                foreach ($month_names as $month) {
                    $userDataCount[$month] = ['month' => $month, 'Athletes' => 0, 'Coach' => 0, 'User' => 0];
                }

                foreach ($userCounts as $countsvalue) {
                    $months = $countsvalue->month;
                    $role = $countsvalue->roles;
                    $count = $countsvalue->count;
                    $userDataCount[$months][$role] = $count;
                }

                $month = [];
                $Athletes = [];
                $Coach = [];
                $User = [];

                foreach ($userDataCount as $graphresult) {
                    $month[] = $graphresult['month'];
                    $Athletes[] = $graphresult['Athletes'];
                    $Coach[] = $graphresult['Coach'];
                    $User[] = $graphresult['User'];
                }

                // 8 Vidio Graph

                $videoCounts = Video::select(DB::raw('MONTHNAME(created_at) as month, video_status, COUNT(*) as count'))
                ->groupBy('month', 'video_status')
                ->orderBy('month', 'desc')
                ->orderBy('video_status')
                ->get();

                $userDataCountvideo = [];
                $month_namesvideo = ["January","February","March","April","May","June","July","August","September","October","November","December"];

                foreach ($month_namesvideo as $monthvideo) {
                    $userDataCountvideo[$monthvideo] = ['month' => $monthvideo, 'Active' => 0, 'InActive' => 0, 'Pending' => 0];
                }

                foreach ($videoCounts as $videocountsvalue) {
                    $videomonths = $videocountsvalue->month;
                    $video_status = $videocountsvalue->video_status;
                    $count = $videocountsvalue->count;
                    if($videocountsvalue->video_status == '1'){
                        $userDataCountvideo[$videomonths]['Active'] = $count;
                    }elseif($videocountsvalue->video_status == '2'){
                        $userDataCountvideo[$videomonths]['InActive'] = $count;
                    }else{
                        $userDataCountvideo[$videomonths]['Pending'] = $count;
                    }
                }
                $videomonth = [];
                $Active = [];
                $InActive = [];
                $Pending = [];

                foreach ($userDataCountvideo as $videographresult) {
                    $videomonth[] = $videographresult['month'];
                    $Active[] = $videographresult['Active'];
                    $InActive[] = $videographresult['InActive'];
                    $Pending[] = $videographresult['Pending'];
                }

                // 9. Video View Graph
                $videoViewCounts = VideoHistory::select(DB::raw('MONTHNAME(created_at) as month, COUNT(*) as count'))
                ->orderBy('month', 'desc')
                ->get();
                if(!empty($videoViewCounts['0']->month)){
                    $userViewCountvideo = [];
                    $monthnamesviewvideo = ["January","February","March","April","May","June","July","August","September","October","November","December"];
                    foreach ($monthnamesviewvideo as $monthviewvideo) {
                        $userViewCountvideo[$monthviewvideo] = ['month' => $monthviewvideo, 'count' => 0];
                    }

                    foreach ($videoViewCounts as $videoviewcountsvalue) {
                        $videoviewmonths = $videoviewcountsvalue->month;
                        $count = $videoviewcountsvalue->count;
                        $userViewCountvideo[$videoviewmonths]['count'] = $count;
                    }
                    $videoviewmonth = [];
                    $viewcount = [];
                    foreach ($userViewCountvideo as $videoviewgraphresult) {
                        $videoviewmonth[] = $videoviewgraphresult['month'];
                        $viewcount[] = $videoviewgraphresult['count'];
                    }
                }else{
                    $videoviewmonth[] = "";
                    $viewcount[] = "";
                }
                return view('admin.dashboard', compact('userCount','athletesCount','coachesCount','totalUsersCount','subscriptionAmount','totalAthleteIncome','referralRevenue','adminIncome','totalVideoCount','pendingCount','approvedCount','rejectedCount','paidCount','freeCount','userDataCount','month','Athletes','Coach','User','videomonth','Active','InActive','Pending','videoviewmonth','viewcount'));
            }else {
                return redirect()->route('admin.login');
            }    
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }
    }


    public function logout(){
        Auth::logout();
        return redirect()->route('admin.login');
    }

}
