<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Offers;
use App\Models\Notification;
use App\Mail\offerStatusMail;
use Mail;


class OfferController extends Controller
{
    public function index($bussiness_id){
        return view('admin.offers.index',compact('bussiness_id'));
    }

    public function getall(Request $request,$id){
        $data = Offers::where('bussiness_id',$id)->orderBy('id','desc')->get();
        return response()->json(['data' => $data]);
    }

    public function setStatus(Request $request) { 
        $id = $request->id;
        $data = Offers::find($id);
        
        $data->status = $request->status;
        
        $data->save();
        $statusMessage = 'Rejected';
        if($request->status == '1'){
            $statusMessage = 'approved';
        }
        
        $email = user::where('id',$data['bussiness_id'])->value('email');
        $data['offer_name'] = $request->offer;
        $data['statusMessage'] = $statusMessage;
        
        Mail::to($email)->send(new offerStatusMail($data));
        $notification = [
            'target_id' => $request->business_id,
            'user_id' => 1,
            'message' => $request->offer.' offer has been '.$statusMessage,
            'date' => date('Y-m-d'),
            'time' => date('H:i a'),
            'target_page' => 'my-offer'
        ];
        
        Notification::create($notification);
        return response()->json(['success' => true]);
    }

    public function show($id)
    {
        $data = Offers::find($id);
        return response()->json(['success' => true,'data' => $data]);
    }

    public function destroy(Request $request,$id)
    {
        Offers::find($id)->delete();
        $notification = [
            'target_id' => $request->business_id,
            'user_id' => 1,
            'message' => $request->offer.' offer has been removed',
            'date' => date('Y-m-d'),
            'time' => date('H:i a'),
            'target_page' => 'my-offer'
        ];
        
        Notification::create($notification);
        return response()->json(['success' => true]);
    }
}
