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
    Question,
    UserAnswere,
    UserIncome,
    VideoCommentHistory
};
use App\Mail\RejectVideoMail;
use App\Mail\ApprovedVideoMail;
class AtheliticsAndCoachesController extends Controller
{
    // Listing
    public function list(){
        $users = User::where('roles','!=','User')->where('roles','!=','Admin')->with('usersubciption')->get();
        return view('admin.atheliticsandcoaches.list', compact('users'));
    }

    // Delete
    public function delete(Request $request){
        $deleted = User::where('id', $request->id)->delete();
        return response()->json(['success'=>'Allergy Deleted Successfully!']);
    }

    // User Detail
    public function ViewDetail($id){
        $users = User::where('id',$id)->first();
        if(empty($users)){
            return redirect()->route('admin.athelitics.list')->with('error', 'invalid Request');
        }
        $userscat = Category::where('category_id',$users->category)->first();
        $usersintro = UserAnswere::where('user_id',$id)->where('question_id','0')->with('IntroVideo')->first();
        $usersAnsweres = UserAnswere::where('user_id',$id)->where('question_id','!=','0')->with('IntroVideo')->get();
        if($users->roles == "Athletes"){
            $QuestonLists = Question::where('question_type','!=','for_coaches')->get();
        }else{
            $QuestonLists = Question::where('question_type','for_coaches')->get();
        }
        foreach ($QuestonLists as $key => $QuestonList) {
            $questionAnswere[$key] = [
                'id' => $QuestonList->question_id,
                'question' => $QuestonList->question,
            ];
            $Questonansweres = UserAnswere::where('question_id',$QuestonList->question_id)->where('user_id',$id)->with('IntroVideo')->first();
            if(!empty($Questonansweres)){
                $questionAnswere[$key]['answere'] = $Questonansweres->IntroVideo['0']->thumbnails;
                $questionAnswere[$key]['video_veiw_count'] = $Questonansweres->IntroVideo['0']->video_veiw_count;
                $questionAnswere[$key]['video_type'] = $Questonansweres->IntroVideo['0']->video_type;
                $questionAnswere[$key]['video_status'] = $Questonansweres->IntroVideo['0']->video_status;
                $questionAnswere[$key]['video_id'] = $Questonansweres->IntroVideo['0']->video_id;
            }else{
                $questionAnswere[$key]['answere'] = "";
                $questionAnswere[$key]['video_veiw_count'] = 0;
                $questionAnswere[$key]['video_type'] = 0;
                $questionAnswere[$key]['video_status'] = 0;
                $questionAnswere[$key]['video_id'] = 0;
            }
        }
        $videolists =  Video::where('user_id',$id)->where('video_from','video')->get();
        $userincomes =  UserIncome::where('user_id',$id)->get();
        $totalIncome = 0;
        foreach ($userincomes as $userincome) {
            $totalvideoIncome = $userincome->videorevenue + $userincome->referralrevenue;
            $totalIncome +=  $totalvideoIncome;
        }
        $totalIncome;
        return view('admin.atheliticsandcoaches.detail', compact('users','usersintro','usersAnsweres','questionAnswere','id','videolists','totalIncome','userincomes','userscat'));
    }


    // Rejected
    public function rejectstatus(Request $request){
        if($request->id == 0){
            return response()->json(['success'=>false , 'data'=> 'change']);
        }else{
            $videoData = Video::where('video_id', $request->id)->first();
            $updateUserData = ['video_status' => '2'];
            Video::where('video_id', $request->id)->update($updateUserData);

            $record = new VideoCommentHistory();
            $record->video_id = $request->id;
            $record->comment = $request->comment;
            $record->save();


            $userId = $videoData->user_id;

            $UserDetail = User::where('id', $userId)->first();

            Mail::to($UserDetail->email)->send(new RejectVideoMail($UserDetail,$videoData));

            return response()->json(['success'=>true]);
        }
    }


    // Aproved
    public function aprrovedstatus(Request $request){
        if($request->id == 0){
            return response()->json(['success'=>false , 'data'=> 'change']);
        }else{
            $videoData = Video::where('video_id', $request->id)->first();
            $updateUserData = ['video_status' => '1' , 'video_type' => $request->type];
            Video::where('video_id', $request->id)->update($updateUserData);
            $userId = $videoData->user_id;

            $UserDetail = User::where('id', $userId)->first();
            Mail::to($UserDetail->email)->send(new ApprovedVideoMail($UserDetail,$videoData));
            return response()->json(['success'=>true , 'data' => $request->type]);
        }
    }


    //Change Type
    public function showVideo(Request $request){
        if($request->id == 0){
            return response()->json(['success'=>false , 'data'=> 'No video']);
        }else{
            $videoData = Video::where('video_id', $request->id)->first();
            if(!empty($videoData)){
                $video = $videoData;
                return response()->json(['success'=>true , 'data'=> $video]);
            }else{
                return response()->json(['success'=>false , 'data'=> 'No video']);
            }
        }
    }

}
