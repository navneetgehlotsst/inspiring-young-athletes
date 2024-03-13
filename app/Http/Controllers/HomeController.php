<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Helper;

class HomeController extends Controller
{
    public function index(){
        return view('web.index');
    }

    public function termCondition(){
        $data = Helper::pageHome('term-condition');
        return view('web.term_condition',compact('data'));
    }

    public function privacyPolicy(){
        $data = Helper::pageHome('privacy-policy');
        return view('web.privacy_policy',compact('data'));
    }

    public function knowledgeBase(){
        return view('web.knowledge_base');
    }

    public function howitworks(){
        return view('web.how_it_works');
    }

    public function aboutus(){
        return view('web.about_us');
    }

    public function newsBlog(){
        return view('web.news_blog');
    }

    public function contactUs(){
        return view('web.contact_us');
    }

    public function contactUsSubmit(Request $request){
        return view('web.index');
    }
}
