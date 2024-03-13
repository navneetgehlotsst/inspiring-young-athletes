<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserPreference;
use App\Models\Category;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Traits\ApiResponser;


class BussinesCategoryController extends Controller
{
    use ApiResponser;

    public function preference(Request $request){
        try {
            $id = auth()->user()->id;
        
            // Get user preferences directly as an array
            $userPreferenceArray = UserPreference::where('user_id', $id)->pluck('preference')->toArray();
        
            // Get categories directly as a collection
            $categories = Category::all();
        
            $finalCategoryResponse = $categories->map(function ($catValue) use ($userPreferenceArray) {
                $isSelected = in_array($catValue->id, $userPreferenceArray) ? 1 : 0;
        
                return [
                    'id' => $catValue->id,
                    'name' => $catValue->name,
                    'image' => $catValue->image,
                    'is_selected' => $isSelected
                ];
            })->toArray();
        
            if (empty($finalCategoryResponse)) {
                return $this->errorResponse('Category not found', 200);
            }
        
        } catch (JWTException $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
        
        return response()->json([
            'status' => 'success',
            'data' => $finalCategoryResponse,
            'message' => 'Category data retrieved.'
        ], 200);
        
    }
}
