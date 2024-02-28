<?php

namespace App\Http\Controllers\Website\AthletesCoach;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\{
    User,
    Video,
    VideoCommentHistory
};

use File;
use FFMpeg;
use FFMpeg\Format\Video\X264;
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\{
    Auth,
};

class VideoConttroller extends Controller
{
    public function add(){
        if (Auth::check()){
            $UserDetail = Auth::user();
            $userID = $UserDetail->id;
            return view('web.athletescoach.addVideo',compact('userID'));
        }else{
            return redirect('')->route('web.login');
        }
    }

    public function storeOld(Request $request){
        $validatedData = $request->validate([
            'title' => 'required',
            'video' => 'required|file|mimes:mp4,mov,avi,wmv',
        ]);

        $UserDetail = Auth::user();
            $userID = $UserDetail->id;

        $Video = $request->file('video');
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
                'video' => $vedopath,
                'video_from' => 'video',
                'video_title' => $request->title,
                'video_ext' => $Video->getClientOriginalExtension(),
                'thumbnails' => $local_thumbnail_path
            ];
            $veid = Video::insertGetId($dataVideo);

        // ->route('admin.branch.list')
        return redirect()->route('web.Video.index')->with('success','Video Uploaded successfully.');
    }

    public function store(Request $request){
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
            'video_from' => 'video',
            'video_title' => $request->title,
            'video_ext' => $extention,
            'thumbnails' => $thumbnail_path_url
        ];
        $veid = Video::insertGetId($dataVideo);

        // ->route('admin.branch.list')
        return redirect()->route('web.Video.index')->with('success','Video has been added successfully.');
    }

    public function index(){
        if (Auth::check()){
            $UserDetail = Auth::user();
            $userID = $UserDetail->id;
            //$getVideo = Video::where('user_id',$userID)->where('Video_from','Video')->get();
            $getVideo = Video::where('user_id',$userID)->where('video_from','video')->get();
            $Videocount = $getVideo->count();

            return view('web.athletescoach.listvideo',compact('userID','getVideo','Videocount'));
        }else{
            return redirect('')->route('web.login');
        }
    }


    public function viewVideo($id){
        if (Auth::check()){
            $getVideo = Video::where('Video_id',$id)->first();

            $popularVideos = Video::where('Video_id','!=',$id)->where('user_id',$getVideo->user_id)->orderBy('Video_veiw_count','DESC')->take(2)->get();

            return view('web.athletescoach.publisher-play-video',compact('getVideo', 'popularVideos'));
        }else{
            return redirect('')->route('web.login');
        }
    }


    public function editVideo($id){
        if (Auth::check()){
            $UserDetail = Auth::user();
            $videodetail = Video::where('video_id',$id)->where('user_id',$UserDetail->id)->first();
            $videorejectedcomment = VideoCommentHistory::where('video_id',$videodetail->video_id)->first();
            return view('web.athletescoach.editVideo',compact('videodetail','videorejectedcomment'));
        }else{
            return redirect('')->route('web.login');
        }
    }


    public function updateVideo(Request $request){
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
        return redirect()->route('web.Video.index')->with('success','Video has been updated successfully.');
    }
}
