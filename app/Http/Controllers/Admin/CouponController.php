<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\GiftToken;
use App\Models\Notification;
use App\Mail\couponStatusMail;
use Mail;


class CouponController extends Controller
{
    public function index($bussiness_id){
        return view('admin.coupon.index',compact('bussiness_id'));
    }

    public function getall(Request $request,$id){
        $data = GiftToken::with('user')->where('bussiness_id',$id)->orderBy('id','desc')->get();
        
        return response()->json(['data' => $data]);
    }

    public function setStatus(Request $request) { 
        $id = $request->id;
        $data = GiftToken::find($id);
        
        $data->status = $request->status;
        
        $data->save();
        $statusMessage = $request->status;
                
        $email = user::where('id',$data['createdby'])->value('email');
        $data['coupon_name'] = $request->coupon;
        $data['statusMessage'] = $statusMessage;
        Mail::to($email)->send(new couponStatusMail($data));
        $notification = [
            'target_id' => $request->created,
            'user_id' => 1,
            'message' => $request->coupon.' coupon has been '.$statusMessage,
            'date' => date('Y-m-d'),
            'time' => date('H:i a'),
            'target_page' => 'coupon'
        ];
        
        Notification::create($notification);
        return response()->json(['success' => true]);
    }

    public function show($id)
    {
        $data = GiftToken::find($id);
        return response()->json(['success' => true,'data' => $data]);
    }

    public function destroy(Request $request,$id)
    {
        GiftToken::find($id)->delete();
        $notification = [
            'target_id' => $request->created,
            'user_id' => 1,
            'message' => $request->coupon.' coupon has been removed',
            'date' => date('Y-m-d'),
            'time' => date('H:i a'),
            'target_page' => 'my-offer'
        ];
        
        Notification::create($notification);
        return response()->json(['success' => true]);
    }
}
