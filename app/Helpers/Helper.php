<?php

namespace App\Helpers;

use App\Models\User;
use App\Models\Category;
use Mail;
use DB,Auth;


class Helper {

    public static function getcategory()
    {
        $category = Category::get();
        return $category;
    }   

}