<?php

namespace App\Http\Controllers\Website\AthletesCoach;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\{
    User,
    Vedio
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
            'vedio' => 'required|file|mimes:mp4,mov,avi,wmv',
        ]);

        $UserDetail = Auth::user();
            $userID = $UserDetail->id;

        $vedio = $request->file('vedio');
            $vedioName = time() . '.' . $vedio->getClientOriginalExtension();
            $path = 'storage/user/'.$userID.'/video';
            $thumbpath = 'storage/user/'.$userID.'/thumbnails';
            if(!File::exists($path)) {
                File::makeDirectory($path, $mode = 0777, true, true);
            }

            if(!File::exists($thumbpath)) {
                File::makeDirectory($thumbpath, $mode = 0777, true, true);
            }
            $vedio->move(public_path($path), $vedioName);
            $vedopath = $path.'/'.$vedioName;
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
            $dataVedio = [
                'user_id' => $userID,
                'vedio' => $vedopath,
                'vedio_from' => 'Vedio',
                'vedio_title' => $request->title,
                'vedio_ext' => $vedio->getClientOriginalExtension(),
                'thumbnails' => $local_thumbnail_path
            ];
            $veid = Vedio::insertGetId($dataVedio);

        // ->route('admin.branch.list')
        return redirect()->route('web.vedio.index')->with('success','Vedio Uploaded successfully.');
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'title' => 'required',
            'vedio' => 'required|file|mimes:mp4,mov,avi,wmv',
        ]);

        $UserDetail = Auth::user();
        $userID = $UserDetail->id;

        //==================== Upload video to s3 ================//

        $file = $request->file('vedio');
        $visibility = 'public';
        $filePath = 'uploads/user/'.$userID.'/video/' . $file->getClientOriginalName();
        Storage::disk('s3')->put($filePath, file_get_contents($file), $visibility);
        $video_path_url = Storage::disk('s3')->url($filePath);


        //===================== get thumbnail from video ===============//

        $file       =  $request->file('vedio');
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

        $dataVedio = [
            'user_id' => $userID,
            'vedio' => $video_path_url,
            'vedio_from' => 'Vedio',
            'vedio_title' => $request->title,
            'vedio_ext' => $extention,
            'thumbnails' => $thumbnail_path_url
        ];
        $veid = Vedio::insertGetId($dataVedio);

    // ->route('admin.branch.list')
    return redirect()->route('web.vedio.index')->with('success','Vedio Uploaded successfully.');
}

    public function index(){
        if (Auth::check()){
            $UserDetail = Auth::user();
            $userID = $UserDetail->id;
            //$getvedio = Vedio::where('user_id',$userID)->where('vedio_from','Vedio')->get();
            $getvedio = Vedio::where('user_id',$userID)->get();
            $vediocount = $getvedio->count();

            return view('web.athletescoach.listVideo',compact('userID','getvedio','vediocount'));
        }else{
            return redirect('')->route('web.login');
        }
    }


    public function viewvedio($id){
        if (Auth::check()){
            $getvedio = Vedio::where('vedio_id',$id)->first();

            $popularVideos = Vedio::where('vedio_id','!=',$id)->where('user_id',$getvedio->user_id)->orderBy('vedio_veiw_count','DESC')->take(2)->get();

            return view('web.athletescoach.publisher-play-video',compact('getvedio', 'popularVideos'));
        }else{
            return redirect('')->route('web.login');
        }
    }
}
