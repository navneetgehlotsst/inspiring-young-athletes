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
    Vedio,
    VideoHistory
};

class HomeController extends Controller
{
    // Home page
    public function Index(){
        $getcategory = Category::where('category_status','1')->take(12)->get();
        //count query pending show data in veiw
        $athleticCoaches = User::where('roles', '!=', 'User')->withCount('videos')->take(9)->get();
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
    // All Category
    public function VideoPublisher($slug){
        $getcategory = Category::where('category_status','1')->get();
        $categoryFirst = Category::where('category_slug',$slug)->first();
        $athleticCoaches = User::where('category', $categoryFirst->category_id)->withCount('videos')->get();
        return view('web.videopublisher',compact('getcategory','categoryFirst','athleticCoaches'));
    }

    // Vedio List
    public function VideoPublisherList($id){
        $userdetail = User::where('id',$id)->withCount('videos')->first();
        $categoryFirst = Category::where('category_id',$userdetail->id)->first();
        $vedioList = Vedio::where('user_id',$userdetail->id)->where('vedio_status','1')->get();

        return view('web.videolist',compact('userdetail','categoryFirst','vedioList'));
    }

    // Vedio
    public function Video($id){
        if (Auth::check()){
            $getvedio = Vedio::where('vedio_id',$id)->first();
            if(empty($getvedio)){
                return Redirect::back()->withError('Video not found!');
            }
            $userId = Auth::id();
            if($userId != $getvedio->user_id ){
                $checkvideoHistory = VideoHistory::where('video_id',$id)->where('user_id',$userId)->first();
                if(empty($checkvideoHistory)){
                    $Viewvidiocount = Vedio::where('vedio_id',$id)->increment('vedio_veiw_count');
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
                $vidoecount = $getvedio->vedio_veiw_count;
            }
            $userdetail = User::where('id',$getvedio->user_id)->withCount('videos')->first();
            $vedioList = Vedio::where('user_id',$userdetail->id)->where('vedio_id','!=',$id)->where('vedio_status','1')->take(8)->get();

            $popularVideos = Vedio::where('vedio_id','!=',$id)->where('user_id',$getvedio->user_id)->orderBy('vedio_veiw_count','DESC')->take(2)->get();

            return view('web.publisher-play-video',compact('getvedio','userdetail','vedioList','vidoecount', 'popularVideos'));
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

}
