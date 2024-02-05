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
    VideoHistory
};

class HomeController extends Controller
{
    // Home page
    public function Index(){
        $getcategory = Category::where('category_status','1')->take(12)->get();
        //count query pending show data in veiw
        $athleticCoaches = User::where('roles', '!=', 'User')->where('roles', '!=', 'Admin')->withCount('videos')->take(9)->get();
        return view('web.home',compact('getcategory','athleticCoaches'));
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

    // Video By Pubisher
    public function VideoPublisher($slug){
        // Default values
        $search = isset($_GET['search']) ? $_GET['search'] : "";
        $categorys = isset($_GET['categorys']) ? $_GET['categorys'] : "";

        // Fetch categories
        $getcategory = Category::where('category_status', '1')->get();
        $athleticCoaches = User::where('roles','!=', 'Admin')
        ->where('roles','!=','User')
        ->withCount('videos');
    
        if (!empty($search)) {
            $athleticCoaches->where('name', 'like', '%' . $search . '%');
        }
        
        if (!empty($categorys)) {
            $athleticCoaches->where('category', $categorys);
        }
        $athleticCoaches = $athleticCoaches->paginate(10);
        $videoCount = $athleticCoaches->total();
        // Fetch category based on slug or category ID
        $categoryFirst = Category::where('category_slug', $slug)->orWhere('category_id', $categorys)->first();
        if(!empty($categorys)){
            $trendingVideo = User::where('category', $categorys)->with('TopVideoList')->get();
        }else{
            $trendingVideo = User::where('category', $categoryFirst->category_id)->with('TopVideoList')->get();
        }
        
        return view('web.videopublisher',compact('getcategory','categoryFirst','athleticCoaches','search','categorys','videoCount','trendingVideo'));
    }

    // All Video List
    public function VideoPublisherAll(){
        $VideoList = Video::where('Video_status','1')->paginate(10);

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
        $categoryFirst = Category::where('category_id',$userdetail->id)->first();
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
            // if($userRole == 'Athletes' || $userRole == 'Coach' ){
            //     return Redirect::back()->withError('you cant see this video');
            // }
            if($userId != $getVideo->user_id ){
                if($userRole == 'Athletes' || $userRole == 'Coach' ){
                    return Redirect::back()->withError('you cant see this video');
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
            $VideoList = Video::where('user_id',$userdetail->id)->where('Video_id','!=',$id)->where('Video_status','1')->take(8)->get();

            $popularVideos = Video::where('Video_id','!=',$id)->where('user_id',$getVideo->user_id)->orderBy('Video_veiw_count','DESC')->take(2)->get();
            
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
            echo "hello"; die;
        }
    }

}
