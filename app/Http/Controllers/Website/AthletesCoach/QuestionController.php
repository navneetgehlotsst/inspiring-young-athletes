<?php

namespace App\Http\Controllers\Website\AthletesCoach;

use App\Http\Controllers\Controller;
use App\Models\{
    Category,
    Role,
    User,
    Question,
    UserAnswere,
    Video
};
use Exception;
use DB;
use Mail;
use File;
use FFMpeg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    Auth,
    Hash,
    Session,
    Storage,
    Validator
};
use Illuminate\Filesystem\Filesystem;
use App\Mail\VerifyUserEmail;

class QuestionController extends Controller
{
    public function atheliticsCoachQuestion(){

        if (Auth::check()){
            $UserDetail = Auth::user();
            $userID = $UserDetail->id;
            $userAnwereCount = UserAnswere::where('user_id',$userID)->count();
            $userAnwereGet = UserAnswere::where('user_id',$userID)->pluck('question_id');
            $userAns = [];
            foreach ($userAnwereGet as $key => $userAnwere) {
                $userAns[] = $userAnwere;
            }
            if($UserDetail->roles == "Athletes"){
                $question = Question::where('question_type', '!=' ,'for_coaches')->get();
                $questionforathletes = Question::where('question_type','for_athletes')->count();
                $questionforparents = Question::where('question_type','for_parents')->count();
                return view('web.athletescoach.questions-athletes',compact('userID','question','questionforathletes','questionforparents','userAnwereCount','userAns'));
            }else{
                $question = Question::where('question_type','for_coaches')->get();
                $questionCount = $question->count();
                return view('web.athletescoach.questions-coaches',compact('userID','question','questionCount','userAnwereCount','userAns'));
            }
        }else{
            return redirect()->route('web.login');
        }
    }

    public function uploadVideo(Request $request)
    {
        $UserDetail = Auth::user();
        $userID = $UserDetail->id;
        $questiontype = $request->questiontype;
        $questionid = $request->questionid;
        $questionTitel = Question::where('question_id',$questionid)->first();
        $validator = Validator::make($request->all(), [
            'Video' => 'required|file|mimes:mp4,mov,avi,wmv',
        ]);

        if($validator->fails()){
            $userAnwereCount = UserAnswere::where('user_id',$userID)->count();
            return response()->json(['success' => false,'message' => 'Upload valid Video','count' => $userAnwereCount]);
        }

        $userAnwereCheck = UserAnswere::where('user_id',$userID)->where('question_id',$questionid)->first();

        if(!empty($userAnwereCheck)){
            $userAnwereCount = UserAnswere::where('user_id',$userID)->count();
            return response()->json(['success' => true, 'message' => 'This question answere already given','count' => $userAnwereCount]);
        }


        $file = $request->file('Video');

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
        $dataVideo = [
            'user_id' => $userID,
            'Video' => $video_path_url,
            'Video_from' => 'QA',
            'Video_title' => $questionTitel->question,
            'Video_ext' => $extention,
            'thumbnails' => $thumbnail_path_url
        ];
        $veid = Video::insertGetId($dataVideo);



        /*
            $Video = $request->file('Video');
            $VideoName = time() . '.' . $Video->getClientOriginalExtension();
            $path = 'storage/user/'.$userID.'/video';
            $thumbpath = 'storage/user/'.$userID.'/thumbnails';
            if(!File::exists($path)) {
                File::makeDirectory($path, $mode = 0777, true, true);
            }

            if(!File::exists($thumbpath)) {
                File::makeDirectory($thumbpath, $mode = 0777, true, true);
            }
            $Video->move(public_path($path), $VideoName);

            $fullPath = $path.'/'.$VideoName;
            //Storage::put($fullPath, $VideoName);
            //Storage::disk('s3')->put($fullPath, $VideoName);

            $s3Path = $request->file('Video')->store(path:'uploads',options:'s3');
            Storage::disk('s3')->setVisibility($s3Path, visibility:'public');

            $vedopath = $path.'/'.$VideoName;
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

            $dataVideo = [
                'user_id' => $userID,
                'Video' => $vedopath,
                'Video_from' => 'QA',
                'Video_title' => $questionTitel->question,
                'Video_ext' => $Video->getClientOriginalExtension(),
                'thumbnails' => $local_thumbnail_path
            ];
            $veid = Video::insertGetId($dataVideo);
        */

        $datauser = [
            'user_id' => $userID,
            'question_id' => $questionid,
            'user_queston_type' => $questiontype,
            'answere_Video' => $veid,
        ];
        $id = UserAnswere::insertGetId($datauser);

        $userAnwereCount = UserAnswere::where('user_id',$userID)->count();

        return response()->json(['success' => true, 'message' => 'Video uploaded successfully','count' => $userAnwereCount]);
    }


    public function removeVideo(Request $request){
        $UserDetail = Auth::user();
        $userID = $UserDetail->id;
        $questionId = $request->id;
        $UserAnswere = UserAnswere::where('user_id', $userID)->where('question_id', $questionId)->first();
        $Video = Video::where('Video_id', $UserAnswere->answere_Video)->first();
        $VideoPath = public_path($Video->Video);
        $thumbnailsPath = public_path($Video->thumbnails);
        if (file_exists($VideoPath)) {
            unlink($VideoPath);
        }

        if (file_exists($thumbnailsPath)) {
            unlink($thumbnailsPath);
        }
        Video::where('Video_id', $UserAnswere->answere_Video)->delete();
        UserAnswere::where('user_id', $userID)->where('question_id', $questionId)->delete();
        $userAnwereCount = UserAnswere::where('user_id',$userID)->count();


        return response()->json(['success' => true,'count' => $userAnwereCount ,'message' => 'Video removed']);
    }


    public function SaveAnswere(){
        $UserDetail = Auth::user();
        $userID = $UserDetail->id;
        $userAnwereCount = UserAnswere::where('user_id',$userID)->count();
        if($userAnwereCount < 1){
            return redirect()->back()->with('error', 'Please Give atleast answere of 1 quertion.');
        }

        if($UserDetail->roles == "Athletes"){
            $userAnwereGet = UserAnswere::where('user_id',$userID)->pluck('user_queston_type');
            $userAns = [];

            foreach ($userAnwereGet as $key => $userAnwere) {
                $userAns[] = $userAnwere;
            }
            // if(!in_array('for_athletes_coaches',$userAns)){
            //     return redirect()->back()->with('error', 'Please Give answere coaches sections.');
            // }

            // if(!in_array('for_friday_frenzy',$userAns)){
            //     return redirect()->back()->with('error', 'Please Give answere Friday Frenzy sections.');
            // }
        }

        $userverifiedbyquestion = User::where('id', $userID)->update(['quetion_status' => '1']);

        return redirect()->route('web.dashboard')->with('success', 'Your Account is verified successfully.');
    }
}
