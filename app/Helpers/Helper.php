<?php

namespace App\Helpers;

use App\Models\User;
use App\Models\Category;
use App\Models\VideoHistory;
use Mail;
use DB,Auth;


class Helper {

    public static function getcategory()
    {
        $category = Category::get();
        return $category;
    }
    
    
    public static function userview($vedio,$userid){
        $videohistory = VideoHistory::where('video_id',$vedio)->where('user_id',$userid)->first();
        return $videohistory;
    }

}