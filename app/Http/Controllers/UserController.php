<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Notification;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index');
    }


    public function getallUser(Request $request){
        $users = User::where('role','user')->orderBy('id','desc')->get();
        return response()->json(['data' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /* public function show($id)
    {
        $user = User::find($id);
        return response()->json(['success' => true,'user' => $user]);
    } */

    public function show($id)
    {
        $data = User::find($id);;
        return view('admin.users.show',compact('data'));
        //return response()->json(['success' => true,'data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return response()->json(['success' => true]);
    }

    public function userStatus(Request $request) { 
        $userid = $request->userid;
        $user = User::find($userid);
        $user->status = $request->status;
        $user->save();
        return response()->json(['success' => true]);
    }

    public function notifications()
    {
        $notification = Notification::where('target_id',Auth::user()->id)->orderBy('id','DESC')->paginate(10);
        Notification::where('target_id',Auth::user()->id)->update(array('read_at'=>'1'));
        return view("admin.users.notification",compact('notification'));
    }

    public function notificationRead($id)
    {
        Notification::where('id',$id)->update(array('read_at'=>'1'));
        return response()->json(['success' => true]);
    }
}
