<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Str;
use App\Http\Traits\ApiResponser;


class CardController extends Controller
{
    use ApiResponser;

    public function AddCard(Request $request){
        echo "hello"; die;
    }

}
