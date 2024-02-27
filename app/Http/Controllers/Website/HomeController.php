<?php

namespace App\Http\Controllers\Website;

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
    UserAnswere,
    Question,
    Plan,
    Subscriptions,
    Transaction,
    AskQuestion
};
use App\Mail\ForgotPasswordMail;
use Laravel\Cashier\Cashier;
class HomeController extends Controller
{
    // Home page
    public function Index(){
        $getcategory = Category::where('category_status','1')->take(12)->get();
        //count query pending show data in veiw
        $athleticCoaches = User::where('roles', '!=', 'User')->where('roles', '!=', 'Admin')->withCount('videos')->take(9)->get();
        if (Auth::check()){
            $UserDetail = Auth::user();
            $userID = $UserDetail->id;
            $checkSubscriptions = Subscriptions::where('user_id',$userID)->first();
        }else{
            $checkSubscriptions = "";
        }
        return view('web.home',compact('getcategory','athleticCoaches','checkSubscriptions'));
    }
    // About page
    public function About(){
        return view('web.about');
    }
    // Coming Soon page
    public function ComingSoon(){
        return view('web.comingsoon');
    }
    // Contact Us
    public function ContactUs(){
        return view('web.contactUS');
    }
    // All Category
    public function AllCategories(){
        $getcategory = Category::where('category_status','1')->get();
        return view('web.categories',compact('getcategory'));
    }
    // All Athletes
    public function Allathletes(){
        // Default values
        $search = isset($_GET['search']) ? $_GET['search'] : "";
        $categorys = isset($_GET['categorys']) ? $_GET['categorys'] : "";


        // Fetch categories
        $getcategory = Category::where('category_status', '1')->get();

        $athleticCoaches = User::where('roles', 'Athletes')
        ->withCount('videos');
    
        if (!empty($search)) {
            $athleticCoaches->where('name', 'like', '%' . $search . '%');
        }
        
        if (!empty($categorys)) {
            $athleticCoaches->where('category', $categorys);
        }
        
        $athleticCoaches = $athleticCoaches->paginate(10);
        
        $videoCount = $athleticCoaches->total();
    
        return view('web.athletes',compact('athleticCoaches','getcategory','search','categorys','videoCount'));
    }

    // All Coach
    public function Allcoach(){
        // Default values
        $search = isset($_GET['search']) ? $_GET['search'] : "";
        $categorys = isset($_GET['categorys']) ? $_GET['categorys'] : "";


        // Fetch categories
        $getcategory = Category::where('category_status', '1')->get();

        $athleticCoaches = User::where('roles', 'Coach')
        ->withCount('videos');
    
        if (!empty($search)) {
            $athleticCoaches->where('name', 'like', '%' . $search . '%');
        }
        
        if (!empty($categorys)) {
            $athleticCoaches->where('category', $categorys);
        }
        
        $athleticCoaches = $athleticCoaches->paginate(10);
        
        $videoCount = $athleticCoaches->total();
        return view('web.coach',compact('athleticCoaches','getcategory','search','categorys','videoCount'));
    }


    public function fridayFrenzy(){
        $VideoList = UserAnswere::where('question_id','45')->join('video', 'user_queston.answere_video', '=', 'video.video_id')->paginate(10);
        return view('web.videolist',compact('VideoList'));
    }

    public function Question(){
        $AthletesList = Question::where('question_status','1')->where('question_type','for_athletes')->get();
        $parentList = Question::where('question_status','1')->where('question_type','for_parents')->get();
        $atheliticsCoachesList = Question::where('question_status','1')->where('question_type','for_athletes_coaches')->get();
        $fridayfrenziList = Question::where('question_status','1')->where('question_type','for_friday_frenzy')->get();
        $CoachList = Question::where('question_status','1')->where('question_type','for_coaches')->get();
        return view('web.question',compact('AthletesList','CoachList','parentList','atheliticsCoachesList','fridayfrenziList'));
    }


    public function QuestionVideo($id){
        $VideoList = UserAnswere::where('question_id',$id)->join('video', 'user_queston.answere_video', '=', 'video.video_id')->paginate(10);
        return view('web.videolist',compact('VideoList'));
    }

    // Video By Pubisher
    public function VideoPublisher($slug){
        // Default values
        $search = isset($_GET['search']) ? $_GET['search'] : "";
        $categorys = isset($_GET['categorys']) ? $_GET['categorys'] : "";
        $categoryFirst = Category::where('category_slug', $slug)->orWhere('category_id', $categorys)->first();
        // Fetch categories
        $getcategory = Category::where('category_status', '1')->get();
        $athleticCoaches = User::where('roles','!=', 'Admin')
        ->where('roles','!=','User')
        ->withCount('videos');
        if (!empty($search)) {
            $athleticCoaches->where('name', 'like', '%' . $search . '%');
        }
        $athleticCoaches->where('category', $categoryFirst->category_id);
        $athleticCoaches = $athleticCoaches->paginate(10);
        $videoCount = $athleticCoaches->total();
        $trendingVideo = User::where('category', $categoryFirst->category_id)->with('TopVideoList')->get();
        
        return view('web.videopublisher',compact('getcategory','categoryFirst','athleticCoaches','search','categorys','videoCount','trendingVideo'));
    }

    // All Video List
    public function VideoPublisherAll(){
        $VideoList = Video::where('Video_status','1')->paginate(10);

        return view('web.videolist',compact('VideoList'));
    }

    // All NewVideo
    public function NewVideo(){
        $lastFiveDays = Carbon::now()->subDays(5);
        $VideoList = Video::whereDate('created_at', '>=', $lastFiveDays)->paginate(10);

        return view('web.videolist',compact('VideoList'));
    }

    // Video list
    public function VideoPublisherList($id , Request $request){
        $url = URL::current();
        $shareComponent = \Share::page($url,'Your share text comes here',)
        ->facebook()
        ->twitter()
        ->linkedin()
        ->telegram()
        ->whatsapp();
        $userdetail = User::where('id',$id)->withCount('videos')->first();
        $categoryFirst = Category::where('category_id',$userdetail->category)->first();
        $VideoList = Video::where('user_id',$userdetail->id)->where('Video_status','1')->paginate(10);

        return view('web.videolist',compact('userdetail','categoryFirst','VideoList','shareComponent','url'));
    }

    // Video
    public function Video($id){
        if (Auth::check()){
            $getVideo = Video::where('Video_id',$id)->first();
            $user = Auth::user();
            $userId = $user->id;
            $userRole = $user->roles;
            if(empty($getVideo)){
                return Redirect::back()->withError('Video not found!');
            }
            $getSubcrption = Subscriptions::where('user_id',$userId)->first();
            $currentDate = date('Y-m-d');
            if($getVideo->video_type == '1'){ 
                if(empty($getSubcrption)){
                    return Redirect::back()->withError('Subscription Required to View Video');
                }
            }
            if($userId != $getVideo->user_id ){
                if($userRole == 'Athletes' || $userRole == 'Coach' ){
                    return Redirect::back()->withError("You have log in with Athleat/Coach so you can't see the video");
                }
                $checkvideoHistory = VideoHistory::where('video_id',$id)->where('user_id',$userId)->first();
                if(empty($checkvideoHistory)){
                    $Viewvidiocount = Video::where('Video_id',$id)->increment('Video_veiw_count');
                    $datavideoHistory= [
                        'video_id' => $id,
                        'user_id' => $userId,
                    ];
                    $id = VideoHistory::insertGetId($datavideoHistory);
                }
            }
            
            if(!empty($Viewvidiocount)){
                $vidoecount = $Viewvidiocount;
            }else{
                $vidoecount = $getVideo->Video_veiw_count;
            }
            $userdetail = User::where('id',$getVideo->user_id)->withCount('videos')->first();
            $VideoList = Video::where('user_id',$getVideo->user_id)->where('video_id','!=',$id)->where('video_status','1')->take(8)->get();

            $popularVideos = Video::where('Video_id','!=',$id)->where('user_id',$getVideo->user_id)->where('video_status','2')->orderBy('Video_veiw_count','DESC')->take(2)->get();
            
            $trendingVideo = User::with('TopVideoList')->get();

            return view('web.publisher-play-video',compact('getVideo','userdetail','VideoList','vidoecount', 'popularVideos','trendingVideo'));
        }else{
            return Redirect::route('web.login')->withError('Please login to view videos.');
        }
    }
    // Login
    public function Login(Request $request){
        $previousUrl = URL::previous();
        $request->session()->put('url', $previousUrl);
        $getcategory = Category::where('category_status','1')->get();
        return view('web.login',compact('getcategory'));
    }

    // Login Post
    public function LoginPost(Request $request){
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $userCheck = User::where('email',$request->email)->first();
        if(empty($userCheck)){
            return redirect()->back()->with('error', 'Invalid credentials..!');
        }else{
            if($userCheck->user_status == 0){
                return redirect()->back()->with('error', 'You are a inactive user!pleae contact to adminstrator');
            }else{
                $credentials = $request->only('email', 'password');
                if (Auth::attempt($credentials))
                {
                    $user = Auth::user();
                    if(empty($user->stripe_id)){
                        $stripeCustomer = $user->createAsStripeCustomer();
                        $user = User::find($user->id);
                        $user->stripe_id = $stripeCustomer->id;
                        $user->save();
                    }
                    if($user->roles == 'User'){
                        if(!empty($url)){
                            $url = Session::get('url');
                            session()->forget('url');
                            return redirect($url);
                        }else{
                            return redirect()->route('web.index')->with('success', 'Login Succesfully.');
                        }
                    }else{
                        if($user->quetion_status == '0'){
                            return redirect()->route('web.athletes.coach.atheliticsCoachQuestion');
                        }else{
                            return redirect()->route('web.dashboard')->with('success', 'Login Succesfully.');
                        }
                    }
                }else{
                    return redirect()->back()->with('error', 'Invalid credentials..!');
                }
            }
        }
    }

    // forgot password
    public function forgotPassword(){
        $getcategory = Category::where('category_status','1')->get();
        return view('web.forgotpassword',compact('getcategory'));
    }

    // forgot password Post
    public function forgotPasswordPost(Request $request){
        $validatedData = $request->validate([
            'email' => 'required|email',
        ]);
        $userCheck = User::where('email',$request->email)->first();
        if(empty($userCheck)){
            return redirect()->back()->with('error', 'Invalid email..!');
        }else{
            DB::table('password_reset_tokens')->where('email',$request->email)->delete();
            $token = Str::random(64);
            DB::table('password_reset_tokens')->insert(['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now() ]);

        try
        {
            Mail::send('web.email.forgetPassword', ['token' => $token], function ($message) use ($request)
            {
                $message->to($request->email);
                $message->subject('Reset Password');
            });
            return redirect('/login')
                ->with('success', 'We have sent a link to reset your password on your email!');
        }
        catch(\Exception $e)
        {
            dd($e);
            return redirect()->back()
                ->with('error', 'email not sent');
        }
        }
    }

    public function showResetPasswordForm($token)
    {
        try {
            $updatePassword = DB::table('password_reset_tokens')->where(['token' => $token])->first();

            if (empty($updatePassword))
            {
                return redirect('/login')->with('error', 'Token Expired!');
            }
            return view('web.setpassword', ['token' => $token]);
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }
        
    }

    public function submitResetPasswordForm(Request $request)
    {

        $request->validate(['new_password' => 'required|confirmed',]);

        $updatePassword = DB::table('password_reset_tokens')->where(['token' => $request
            ->token])
            ->first();

        if (!$updatePassword)
        {
            return redirect()->back()
                ->with('error', 'Invalid token!');
        }

        $user = User::where('email', $updatePassword->email)
            ->update(['password' => Hash::make($request->new_password) ]);
        DB::table('password_reset_tokens')
            ->where(['email' => $updatePassword
            ->email])
            ->delete();

        return redirect('/login')
            ->with('success', 'Your password has updated successfully.Please log in!');
    }

    public function joinNow(){
        if (Auth::check()){
            $UserDetail = Auth::user();
            $userID = $UserDetail->id;
            if($UserDetail->roles == "User"){
                $planGet = Plan::where('status','1')->first();
                $PlanId = $planGet->id;
                $intent = $UserDetail->createSetupIntent();
                $inttentId = $intent->client_secret;
                return view('web.subscription',compact('PlanId','inttentId'));
            }else{
                return redirect()->back()->with('error', 'Athletics And Coach Cant buy this subscription');
            }
        }else{
            return redirect()->route('web.login');
        }
    }

    public function subscription(Request $request)
    {   
        try {
            if (Auth::check()) {
                $user = Auth::user();
                $plan = Plan::find($request->plan);
        
                if (!$plan) {
                    return redirect()->route('web.index')->with('error', 'Invalid Plan');
                }
        
                $subscription = $user->newSubscription($request->plan, $plan->plan)->create($request->token);
                $transactionData = [
                    'user_id' => $user->id,
                    'amount' => $plan->price,
                    'transaction_id' => $subscription->stripe_id,
                    'transaction_type' => 'subscription',
                    'status' => $subscription->stripe_status,
                ];
        
                // Use a transaction to ensure data consistency
                $transaction = Transaction::create($transactionData);
        
                if ($subscription->stripe_status == 'active') {
                    return redirect()->route('web.athletes.coach.MySubcription')->with('success', 'Subscription Created Successfully');
                } else {
                    return redirect()->route('web.index')->with('error', 'Subscription Not Created Successfully');
                }
            } else {
                return redirect()->route('web.login');
            }
        } catch (\Throwable $th) {
            return back()->with('error',$th->getMessage());
        }
        
    }


    public function askquestion(Request $request)
    {   
        try {
            AskQuestion::insert([
                'full_name' => $request->name,
                'email' => $request->email,
                'coachandatheletes' => $request->atheliticsandcoachname,
                'description' => $request->askquestion
            ]);
            return back()->with('success','Ask Question message');
        } catch (\Throwable $th) {
            return back()->with('error',$th->getMessage());
        }
        
    }

}
