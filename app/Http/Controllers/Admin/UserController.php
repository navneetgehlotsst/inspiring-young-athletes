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
    Subscriptions
};

class UserController extends Controller
{
    // Listing
    public function list(){
        $users = User::where('roles','User')->with('usersubciption')->get();
        return view('admin.user.list', compact('users'));
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
            return redirect()->route('admin.user.list')->with('error', 'invalid Request');
        }
        $userSubscriptions = Subscriptions::where('user_id',$id)->first();
        if(!empty($usersubciption)){
            $startDate = $usersubciption->created_at; // Assuming usersubciption is a relationship
            $formattedStartDate = Carbon::parse($startDate)->format('d-m-Y');
            $enddate = Carbon::parse($formattedStartDate)->addDays(30)->format('d-m-Y');
        }else{
            $formattedStartDate = "";
            $enddate = "";
        }
        return view('admin.user.detail', compact('users','formattedStartDate','enddate'));
    }

}
