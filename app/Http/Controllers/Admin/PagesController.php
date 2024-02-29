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
    AskQuestion
};

class PagesController extends Controller
{
    // Ask Question Listing
    public function askquestionlist(){
        $asks = AskQuestion::get();
        return view('admin.pages.asklist', compact('asks'));
    }


    // FAQ Listing
    public function faqlist(){
        $asks = AskQuestion::get();
        return view('admin.pages.faqlist', compact('asks'));
    }
}