<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;


class BusinessController extends Controller
{
    public function index(){
        return view('admin.business.index');
    }

    public function getall(Request $request){
        $data = User::with(['plan' => function ($que) {
            $que->where('expiry_date','>=',date('Y-m-d'))
            ->where('status','Active')
            ->select('id', 'business_id','plan')
            ->orderBy('id','desc');
            }])->where('role','business')->orderBy('id','desc')->get();
        
        return response()->json(['data' => $data]);
    }

    public function setStatus(Request $request) { 
        $id = $request->id;
        $data = User::find($id);
        $data->status = $request->status;
        $data->save();
        return response()->json(['success' => true]);
    }

    public function show($id)
    {
        $data = User::whereId($id)->first();
        $catList = Category::pluck('name','id');
        $category = [];
        if($data->category){
            $category = json_decode($data->category);
        }
        $busOperation = [];
        foreach($data->busOperation as $key => $busOpp){
            $busOperation[$busOpp->business_day][] = $busOpp->open_time;
            $busOperation[$busOpp->business_day][] = $busOpp->close_time;
        }
        
        return view('admin.business.show',compact('data','category','catList'));
        //return response()->json(['success' => true,'data' => $data]);
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return response()->json(['success' => true]);
    }
}
