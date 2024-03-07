<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use Mail,Hash,File,Auth,DB,Helper,Exception,Session,Redirect,Validator;
use Carbon\Carbon;

class FaqController extends Controller
{
    public function list()
    {
        $faqs = Faq::get();
        return view('admin.faq.list', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faq.create');
    }

    public function store(Request $request)
    {
        try{
            $faq = new Faq();
            $faq->create($request->all());
            return redirect()->route('admin.faq.list')->with('success', 'FAQ added successfully');

        }catch(Exception $e){
            return redirect()->route('admin.faq.list')->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        try{    
            $faq = Faq::find($id);
            return view('admin.faq.edit', compact('faq'));
        }catch(Exception $e){
            return redirect()->route('admin.faq.list')->with('error', $e->getMessage());
        }
    }

    public function update(Request $request)
    {
        try{    
            $faq = Faq::find($request->faqid);
            $faq->update($request->all());
            return redirect()->route('admin.faq.list')->with('success', 'FAQ updated successfully');
        }catch(Exception $e){
            return redirect()->route('admin.faq.list')->with('error', $e->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        try{    
            $faq = Faq::find($request->id);
            $faq->delete();
            return redirect()->route('admin.faq.list')->with('success', 'FAQ deleted successfully');
        }catch(Exception $e){
            return redirect()->route('admin.faq.list')->with('error', $e->getMessage());
        }
    }
}
