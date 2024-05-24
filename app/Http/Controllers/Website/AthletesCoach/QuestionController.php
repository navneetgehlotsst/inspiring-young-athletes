<?php

namespace App\Http\Controllers\Website\AthletesCoach;

use App\Http\Controllers\Controller;
use App\Models\{
    Category,
    Role,
    User,
    Question,
    UserAnswere,
    Video,
    VideoCommentHistory
};
use Exception;
use DB;
use Mail;
use File;
use FFMpeg;
use FFMpeg\Format\Video\X264;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    Auth,
    Hash,
    Session,
    Storage,
    Validator
};
use App\Mail\VerifyUserEmail;

class QuestionController extends Controller
{
    public function atheliticsCoachQuestion(Request $request){
        if (Auth::check()){
            $UserDetail = Auth::user();
            $userID = $UserDetail->id;
            $checkIntro = UserAnswere::where('user_id',$userID)->where('question_id','0')->count();
            $userAnswerCount = UserAnswere::where('user_id',$userID)->where('question_id','!=','0')->count();
            if($checkIntro == 0){
                return redirect()->route('web.athletes.coach.verificationSuccess')->with('error', 'Intro Video is required');
            }
            $userAnwereGet = UserAnswere::where('user_id',$userID)->pluck('question_id');
            $userAns = [];
            foreach ($userAnwereGet as $key => $userAnwere) {
                $userAns[] = $userAnwere;
            }
            if($UserDetail->roles == "Athlete"){
                $question = Question::where('question_type', '!=' ,'for_coaches')->get();
                $questionforathletes = Question::where('question_type','for_athletes')->count();
                $questionforparents = Question::where('question_type','for_parents')->count();
                return view('web.athletescoach.questions-athletes',compact('userID','question','questionforathletes','questionforparents','userAnswerCount','userAns'));
            }else{
                $question = Question::where('question_type','for_coaches')->get();
                $questionCount = $question->count();
                return view('web.athletescoach.questions-coaches',compact('userID','question','questionCount','userAnswerCount','userAns','UserDetail'));
            }
        }else{
            return redirect()->route('web.login');
        }
    }

    public function uploadvideo(Request $request)
    {
        $UserDetail = Auth::user();
        $userID = $UserDetail->id;
        $questionid = $request->questionid;
        if($questionid != 0){
            $questionTitel = Question::where('question_id',$questionid)->first();
            $question = $questionTitel->question;
            $questiontype = $request->questiontype;
        }else{
            $question = "Intro Video";
            $questiontype = "video";
        }

        $validator = Validator::make($request->all(), [
            'video' => 'required|file|mimes:mp4,mov,avi,wmv',
        ]);

        if($validator->fails()){
            $userAnwereCount = UserAnswere::where('user_id',$userID)->where('question_id','!=','0')->count();
            return response()->json(['success' => false,'message' => 'Upload valid video','count' => $userAnwereCount]);
        }

        $userAnwereCheck = UserAnswere::where('user_id',$userID)->where('question_id',$questionid)->first();

        if(!empty($userAnwereCheck)){
            $userAnwereCount = UserAnswere::where('user_id',$userID)->where('question_id','!=','0')->count();
            return response()->json(['success' => true, 'message' => 'This question answer already given','count' => $userAnwereCount]);
        }


        $file = $request->file('video');

        //==================== Upload video to s3 ================//
        $visibility = 'public';
        $filePath = 'uploads/user/'.$userID.'/video/' . $file->getClientOriginalName();
        Storage::disk('s3')->put($filePath, file_get_contents($file), $visibility);
        $video_path_url = Storage::disk('s3')->url($filePath);


        //===================== get thumbnail from video ===============//
        $extention  =  $file->getClientOriginalExtension();
        $filename   =   time().$file->getClientOriginalName();
        $filename   =   $this->clean($filename);
        $folder     =   'uploads/thumbnail/';
        $path       =   public_path($folder);
        if(!File::exists($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
        }
        $file->move($path, $filename);
        $video_path   = $folder.$filename;

        $ffmpeg = FFMpeg\FFMpeg::create([
            'ffmpeg.binaries'  => env('FFMPEG_PATH'),
            'ffprobe.binaries' => env('FFPROBE_PATH'),
            'timeout'          => 3600,
            'ffmpeg.threads'   => 12,
        ]);

        $s3_thumb_folder = 'uploads/user/'.$userID.'/video_thumbnail/';
        $local_thumbnail_folder = 'uploads/thumbnail/';
        $filevideo = $ffmpeg->open($video_path);
        $frame_path = time().'_'.rand().'.jpg';
        $filevideo->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(3))->save('uploads/thumbnail/'.$frame_path);
        $local_thumbnail_path = $local_thumbnail_folder.$frame_path;
        $s3_thumb_path = $s3_thumb_folder.$frame_path;


        //======================Upload thumbanial to s3 bucket ======================//
        Storage::disk('s3')->put($s3_thumb_path, file_get_contents($local_thumbnail_path), $visibility);
        $thumbnail_path_url = Storage::disk('s3')->url($s3_thumb_path);

        //======================Clean directory localy use for save ==================//
        $dir = new Filesystem;
        $dir->cleanDirectory('uploads/thumbnail');

        // SAVE TO THE TABLES
        $datavideo = [
            'user_id' => $userID,
            'video' => $video_path_url,
            'video_from' => 'QA',
            'video_title' => $question,
            'video_ext' => $extention,
            'thumbnails' => $thumbnail_path_url
        ];
        $veid = Video::insertGetId($datavideo);



        /*
            $video = $request->file('video');
            $videoName = time() . '.' . $video->getClientOriginalExtension();
            $path = 'storage/user/'.$userID.'/video';
            $thumbpath = 'storage/user/'.$userID.'/thumbnails';
            if(!File::exists($path)) {
                File::makeDirectory($path, $mode = 0777, true, true);
            }

            if(!File::exists($thumbpath)) {
                File::makeDirectory($thumbpath, $mode = 0777, true, true);
            }
            $video->move(public_path($path), $videoName);

            $fullPath = $path.'/'.$videoName;
            //Storage::put($fullPath, $videoName);
            //Storage::disk('s3')->put($fullPath, $videoName);

            $s3Path = $request->file('video')->store(path:'uploads',options:'s3');
            Storage::disk('s3')->setVisibility($s3Path, visibility:'public');

            $vedopath = $path.'/'.$videoName;
            $thumbnailPath = 'thumbnails/' . pathinfo($vedopath, PATHINFO_FILENAME) . '.jpg';
            $ffmpeg = FFMpeg\FFMpeg::create([
                'ffmpeg.binaries'  => env('FFMPEG_PATH'),
                'ffprobe.binaries' => env('FFPROBE_PATH'),
                'timeout'          => 3600,
                'ffmpeg.threads'   => 12,
            ]);

            $filevideo = $ffmpeg->open($vedopath);
            $frame_path = time().'.jpg';
            $filevideo->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(3))->save($thumbpath.'/'.$frame_path);
            $local_thumbnail_path = $thumbpath.'/'.$frame_path;

            $datavideo = [
                'user_id' => $userID,
                'video' => $vedopath,
                'video_from' => 'QA',
                'video_title' => $questionTitel->question,
                'video_ext' => $video->getClientOriginalExtension(),
                'thumbnails' => $local_thumbnail_path
            ];
            $veid = Video::insertGetId($datavideo);
        */

        $datauser = [
            'user_id' => $userID,
            'question_id' => $questionid,
            'user_queston_type' => $questiontype,
            'answere_video' => $veid,
        ];
        $id = UserAnswere::insertGetId($datauser);

        $userAnwereCount = UserAnswere::where('user_id',$userID)->where('question_id','!=','0')->count();

        return response()->json(['success' => true, 'message' => 'video uploaded successfully','count' => $userAnwereCount]);
    }


    public function removevideo(Request $request){
        $UserDetail = Auth::user();
        $userID = $UserDetail->id;
        $questionId = $request->id;
        $UserAnswere = UserAnswere::where('user_id', $userID)->where('question_id', $questionId)->first();
        $video = Video::where('video_id', $UserAnswere->answere_video)->first();
        $videoPath = public_path($video->video);
        $thumbnailsPath = public_path($video->thumbnails);
        if (file_exists($videoPath)) {
            unlink($videoPath);
        }

        if (file_exists($thumbnailsPath)) {
            unlink($thumbnailsPath);
        }
        Video::where('video_id', $UserAnswere->answere_video)->delete();
        UserAnswere::where('user_id', $userID)->where('question_id', $questionId)->delete();
        $userAnwereCount = UserAnswere::where('user_id',$userID)->count();


        return response()->json(['success' => true,'count' => $userAnwereCount ,'message' => 'Video removed']);
    }


    public function SaveAnswere(){
        $UserDetail = Auth::user();
        $userID = $UserDetail->id;
        $userAnwereCount = UserAnswere::where('user_id',$userID)->count();
        if($userAnwereCount < 1){
            return redirect()->back()->with('error', 'Please Give atleast answer of 1 Question.');
        }

        if($UserDetail->roles == "Athletes"){
            $userAnwereGet = UserAnswere::where('user_id',$userID)->pluck('user_queston_type');
            $userAns = [];

            foreach ($userAnwereGet as $key => $userAnwere) {
                $userAns[] = $userAnwere;
            }
            // if(!in_array('for_athletes_coaches',$userAns)){
            //     return redirect()->back()->with('error', 'Please Give answer coaches sections.');
            // }

            // if(!in_array('for_friday_frenzy',$userAns)){
            //     return redirect()->back()->with('error', 'Please Give answer Friday Frenzy sections.');
            // }
        }

        $userverifiedbyquestion = User::where('id', $userID)->update(['quetion_status' => '1']);

        return redirect()->route('web.dashboard')->with('success', 'Your Account is verified successfully.');
    }


    public function UpdateRole(){
        try {
            if (Auth::check()){
                $UserDetail = Auth::user();
                $userID = $UserDetail->id;
                $getrole = Role::latest()->take(2)->get();
                return view('web.athletescoach.role_update',compact('userID','UserDetail','getrole'));
            }else{
                return redirect()->route('web.login');
            }
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }
    }


    public function SaveRole(Request $request){
        try {
            if (Auth::check()){
                $UserDetail = Auth::user();
                $userID = $UserDetail->id;

                User::where('id',$userID)
                ->update(['roles' => $request->role]);

                $UserAnswere = UserAnswere::where('user_id',$userID)->where('question_id','!=','0');
                if($UserAnswere) {
                    $UserAnswere->delete();
                }

                $Video = Video::where('user_id',$userID)->where('video_title','!=','Intro Video');
                if($Video){
                    $Video->delete();
                }

                return redirect()->route('web.athletes.coach.atheliticsCoachQuestion')->with('success', 'Your Role Has Been changed.');
            }else{
                return redirect()->route('web.login');
            }
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }
    }

    public function questionandanswere($new_video = null){
        if (Auth::check()){
            $UserDetail = Auth::user();
            $questionathelitics = Question::where('question_type', '!=' ,'for_coaches')->get();
            $questioncoaches = Question::where('question_type','for_coaches')->get();
            $userAnwereGet = UserAnswere::where('user_id',$UserDetail->id)->where('question_id','!=','0')->pluck('question_id');
            $userAns = [];
            foreach ($userAnwereGet as $key => $userAnwere) {
                $userAns[] = $userAnwere;
            }
            if($new_video == "add_question"){
                return redirect()->route('web.athletes.coach.questionandanswere')->with('success','Video has been added successfully.');
            }elseif($new_video == 'update_question'){
                return redirect()->route('web.athletes.coach.questionandanswere')->with('success','Video has been updated successfully.');
            }else{
                return view('web.athletescoach.questionandans',compact('questionathelitics','questioncoaches','UserDetail','userAns'));
            }
        }else{
            return redirect('')->route('web.login');
        }
    }

    public function showVideo(Request $request){
        if($request->id == 0){
            return response()->json(['success'=>false , 'data'=> 'No video']);
        }else{
            $UserDetail = Auth::user();
            $userAnwereGet = UserAnswere::where('user_id',$UserDetail->id)->where('question_id',$request->id)->first();
            $videoData = Video::where('video_id', $userAnwereGet->answere_video)->first();
            if(!empty($videoData)){
                $video = $videoData;
                return response()->json(['success'=>true , 'data'=> $video]);
            }else{
                return response()->json(['success'=>false , 'data'=> 'No video']);
            }
        }
    }

    public function addQuestionVideo($id){
        if (Auth::check()){
            $UserDetail = Auth::user();
            $questiondetail = Question::where('question_id',$id)->first();
            return view('web.athletescoach.addquesVideo',compact('questiondetail'));
        }else{
            return redirect('')->route('web.login');
        }
    }

    public function editQuestionVideo($id){
        if (Auth::check()){
            $UserDetail = Auth::user();
            $questiondetail = Question::where('question_id',$id)->first();
            $videodetail = UserAnswere::where('question_id',$id)->where('user_id',$UserDetail->id)->with('VideoDetail')->first();
            $videorejectedcomment = VideoCommentHistory::where('video_id',$videodetail['VideoDetail']->video_id)->first();
            return view('web.athletescoach.editquesVideo',compact('questiondetail','videodetail','videorejectedcomment'));
        }else{
            return redirect('')->route('web.login');
        }
    }


    public function questionupdateVideo(Request $request){
        $validatedData = $request->validate([
            'video' => 'required|file|mimes:mp4,mov,avi,wmv',
        ]);

        $UserDetail = Auth::user();
        $userID = $UserDetail->id;

        //==================== Upload video to s3 ================//

        $file = $request->file('video');
        $visibility = 'public';
        $filePath = 'uploads/user/'.$userID.'/video/' . $file->getClientOriginalName();
        Storage::disk('s3')->put($filePath, file_get_contents($file), $visibility);
        $video_path_url = Storage::disk('s3')->url($filePath);


        //===================== get thumbnail from video ===============//

        $file       =  $request->file('video');
        $extention  =  $file->getClientOriginalExtension();
        $filename   =   time().$file->getClientOriginalName();
        $filename   =   $this->clean($filename);
        $folder     =   'uploads/thumbnail/';
        $path       =   public_path($folder);
        if(!File::exists($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
        }
        $file->move($path, $filename);
        $video_path   = $folder.$filename;

        $ffmpeg = FFMpeg\FFMpeg::create([
            'ffmpeg.binaries'  => env('FFMPEG_PATH'),
            'ffprobe.binaries' => env('FFPROBE_PATH'),
            'timeout'          => 3600,
            'ffmpeg.threads'   => 12,
        ]);

        $s3_thumb_folder = 'uploads/user/'.$userID.'/video/';
        $local_thumbnail_folder = 'uploads/thumbnail/';
        $filevideo = $ffmpeg->open($video_path);
        $frame_path = time().'_'.rand().'.jpg';
        $filevideo->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(3))->save('uploads/thumbnail/'.$frame_path);
        $local_thumbnail_path = $local_thumbnail_folder.$frame_path;
        $s3_thumb_path = $s3_thumb_folder.$frame_path;

        //======================Upload thumbanial to s3 bucket ======================//

        Storage::disk('s3')->put($s3_thumb_path, file_get_contents($local_thumbnail_path), $visibility);
        $thumbnail_path_url = Storage::disk('s3')->url($s3_thumb_path);

        //======================Clean directory localy use for save ==================//
        $dir = new Filesystem;
        $dir->cleanDirectory('uploads/thumbnail');

        $dataVideo = [
            'user_id' => $userID,
            'video' => $video_path_url,
            'video_title' => $request->title,
            'video_ext' => $extention,
            'thumbnails' => $thumbnail_path_url,
            'video_status' => '0'
        ];
        $veid = Video::where('video_id', $request->videoid)->update($dataVideo);
        //return redirect()->route('web.athletes.coach.questionandanswere')->with('success','Video has been updated successfully.');
        return response()->json(['success' => true, 'message' => 'Video has been updated successfully.']);
    }

    public function questionstoreVideo(Request $request){
        $validatedData = $request->validate([
            'title' => 'required',
            'video' => 'required|file|mimes:mp4,mov,avi,wmv',
        ]);

        $UserDetail = Auth::user();
        $userID = $UserDetail->id;

        //==================== Upload video to s3 ================//

        $file = $request->file('video');
        $visibility = 'public';
        $filePath = 'uploads/user/'.$userID.'/video/' . $file->getClientOriginalName();
        Storage::disk('s3')->put($filePath, file_get_contents($file), $visibility);
        $video_path_url = Storage::disk('s3')->url($filePath);


        //===================== get thumbnail from video ===============//

        $file       =  $request->file('video');
        $extention  =  $file->getClientOriginalExtension();
        $filename   =   time().$file->getClientOriginalName();
        $filename   =   $this->clean($filename);
        $folder     =   'uploads/thumbnail/';
        $path       =   public_path($folder);
        if(!File::exists($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
        }
        $file->move($path, $filename);
        $video_path   = $folder.$filename;

        $ffmpeg = FFMpeg\FFMpeg::create([
            'ffmpeg.binaries'  => env('FFMPEG_PATH'),
            'ffprobe.binaries' => env('FFPROBE_PATH'),
            'timeout'          => 3600,
            'ffmpeg.threads'   => 12,
        ]);

        $s3_thumb_folder = 'uploads/user/'.$userID.'/video/';
        $local_thumbnail_folder = 'uploads/thumbnail/';
        $filevideo = $ffmpeg->open($video_path);
        $frame_path = time().'_'.rand().'.jpg';
        $filevideo->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(3))->save('uploads/thumbnail/'.$frame_path);
        $local_thumbnail_path = $local_thumbnail_folder.$frame_path;
        $s3_thumb_path = $s3_thumb_folder.$frame_path;

        //======================Upload thumbanial to s3 bucket ======================//

        Storage::disk('s3')->put($s3_thumb_path, file_get_contents($local_thumbnail_path), $visibility);
        $thumbnail_path_url = Storage::disk('s3')->url($s3_thumb_path);

        //======================Clean directory localy use for save ==================//
        $dir = new Filesystem;
        $dir->cleanDirectory('uploads/thumbnail');

        $dataVideo = [
            'user_id' => $userID,
            'video' => $video_path_url,
            'video_from' => 'QA',
            'video_title' => $request->title,
            'video_ext' => $extention,
            'thumbnails' => $thumbnail_path_url
        ];
        $veid = Video::insertGetId($dataVideo);

        $datauser = [
            'user_id' => $userID,
            'question_id' => $request->quesid,
            'user_queston_type' => $request->type,
            'answere_video' => $veid,
        ];
        $id = UserAnswere::insertGetId($datauser);

        // ->route('admin.branch.list')
        //return redirect()->route('web.athletes.coach.questionandanswere')->with('success','Video has been added successfully.');
        return response()->json(['success' => true, 'message' => 'Video has been updated successfully.']);
    }
}
