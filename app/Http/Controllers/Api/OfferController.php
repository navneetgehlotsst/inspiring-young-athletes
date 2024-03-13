<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Offers;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;


class offerList extends Controller
{
    public function category(Request $request){
        try {
            $categories = Category::all();
            if (!$categories) {
                return response()->json([
                    'status' => 'error',
                    'errors' =>  '',
                    'message'=>'Category not found'
                ],403);
                return $this->sendError([], "Category not found", 403);
            }
        } catch (JWTException $e) {
            return response()->json([
                'status' => 'error',
                'errors' =>  $e->getMessage(),
                'message'=>''
            ],500);

        }
        return response()->json([
            'status' => 'success',
            'data' => $categories,
            'message'=>'Category data retrieved.'
        ],200);

        return $this->sendResponse($categories, "Category data retrieved", 200);
    }
}
