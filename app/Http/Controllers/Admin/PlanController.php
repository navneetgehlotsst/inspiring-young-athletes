<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\Notification;
use Illuminate\Support\Str;


class PlanController extends Controller
{
    public function index(){
        return view('admin.plans.index');
    }

    public function getall(Request $request){
        $data = Plan::orderBy('id','desc')->get();
        return response()->json(['data' => $data]);
    }

    public function create(){
        return view('admin.plans.create');
    }

    public function store(Request $request){
        
        $request->validate([
            "name" => "required",
            "content" => "required",
            "amount" => "required",
            "total_offer" => "required",
            "valid_days" => "required",
        ]);
        try{
            $data = $request->all();
            $data['status'] = 'Active';
            $data['discount_percent'] = 0;
            $data['total_amount'] = $request->amount;
            if(!empty($request->discount_percent)){
                $data['discount_percent'] = $request->discount_percent;
                $data['total_amount'] = $request->amount-($request->amount*$request->discount_percent)/100;
            }
           
            Plan::create($data);
            return redirect()->route('admin.plans.index')->withSuccess('Plan has been created successfully');
        }catch(Exception $e){
            return back()->withInput()->withError($e->getMessage());
        }
    }

    public function edit($id){
        $data = Plan::find($id);
        return view('admin.plans.edit',compact('data'));
    }

    public function update(Request $request,$id){
        $request->validate([
            "name" => "required",
            "content" => "required",
            "amount" => "required",
            "total_offer" => "required",
            "valid_days" => "required",
        ]);
        
       try{
            $data = $request->all();
            $data['discount_percent'] = 0;
            $data['total_amount'] = $request->amount;
            if(!empty($request->discount_percent)){
                $data['discount_percent'] = $request->discount_percent;
                $data['total_amount'] = $request->amount-($request->amount*$request->discount_percent)/100;
            }

           
            Plan::find($id)->update($data);
            return redirect()->route('admin.plans.index')->withSuccess('Plan has been updated successfully');
        }catch(Exception $e){
            return back()->withInput()->withError($e->getMessage());
        }
    }

    public function setStatus(Request $request) { 
        $id = $request->id;
        $data = Plan::find($id);
        
        $data->status = $request->status;
        
        $data->save();
        $statusMessage = 'Inactive';
        if($request->status == 'Active'){
            $statusMessage = 'Active';
        }
        
        return response()->json(['success' => true]);
    }

    public function show($id)
    {
        $data = Plan::find($id);
        return response()->json(['success' => true,'data' => $data]);
    }

    public function destroy(Request $request,$id)
    {
        Plan::find($id)->delete();
        return response()->json(['success' => true]);
    }
}
