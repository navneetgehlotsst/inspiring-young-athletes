<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\BusinessFavorite;
use App\Models\Offers;
use App\Models\Page;
use App\Models\Notification;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Traits\ApiResponser;

class HomeController extends Controller
{
    use ApiResponser;

    // Home page
    public function homepage(Request $request){
        $base_url = url('/').'/';
        $Userdetail = auth()->user();
        $data = $request->all();
        $validator = Validator::make($data, [
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $distanceUnit = 300;
        // Recommrnded
        $query = User::select("users.id","users.first_name","users.last_name","users.full_name","users.business_name","users.email","users.country_code","users.phone","users.role","users.address","users.area","users.city","users.avatar","users.featured","users.goodwill",DB::raw("6371 * acos(cos(radians(".$latitude."))*cos(radians(users.latitude)) *cos(radians(users.longitude) - radians(".$longitude."))+sin(radians(".$latitude."))*sin(radians(users.latitude))) AS distance"));
        //$query->join('business_category', 'users.category', '=', 'business_category.id');
        $query->where('users.status','active');
        $query->where('users.role','business');
        $query->havingRaw('distance < '.$distanceUnit);
        $query->where('featured','1');
        $Businessrecommended = $query->get();
        $Businessrecommendedcount = $query->count();
        if ($Businessrecommendedcount != '0') {
            foreach ($Businessrecommended as $key => $Businessrecom) {
                if($Businessrecom->avatar){
                    $Businessrecom->avatar = $base_url.$Businessrecom->avatar;
                }else{
                    $Businessrecom->avatar = "";
                }
                $BusinessFavoriteCheckrecom = BusinessFavorite::where('user_id',$Userdetail->id)->where('bussiness_id',$Businessrecom->id)->first();
                if(!empty($BusinessFavoriteCheckrecom)){
                    $Businessrecom->is_favorite = '1';
                }else{
                    $Businessrecom->is_favorite = '0';
                }
            }
            $Businessrecommended->avatar = $Businessrecom->avatar;
            $Businessdata['recommended'] = $Businessrecommended;

        }else{
            $Businessdata['recommended'] = [];
        }

        $querynreaby = User::select("users.id","users.first_name","users.last_name","users.full_name","users.business_name","users.email","users.country_code","users.phone","users.role","users.address","users.area","users.city","users.avatar","users.latitude","users.longitude","users.featured","users.goodwill",DB::raw("6371 * acos(cos(radians(".$latitude."))*cos(radians(users.latitude)) *cos(radians(users.longitude) - radians(".$longitude."))+sin(radians(".$latitude."))*sin(radians(users.latitude))) AS distance"));
        $querynreaby->join('business_category', 'users.category', '=', 'business_category.id');
        $querynreaby->where('users.status','active');
        $querynreaby->where('users.role','business');
        $querynreaby->havingRaw('distance < '.$distanceUnit);
        $Businessnearby = $querynreaby->get();
        $Businessnearbycount = $querynreaby->count();
        if ($Businessnearbycount != '0') {


            foreach ($Businessnearby as $key => $Businessnear) {
                if($Businessnear->avatar){
                    $Businessnear->avatar = $base_url.$Businessnear->avatar;
                }else{
                    $Businessnear->avatar = "";
                }
                $BusinessFavoriteCheck = BusinessFavorite::where('user_id',$Userdetail->id)->where('bussiness_id',$Businessnear->id)->first();
                if(!empty($BusinessFavoriteCheck)){
                    $Businessnear->is_favorite = '1';
                }else{
                    $Businessnear->is_favorite = '0';
                }
            }
            $Businessnearby->avatar = $Businessnear->avatar;
            $Businessdata['NearBy'] = $Businessnearby;
        }else{
            $Businessdata['NearBy'] = [];
        }
        if ($Businessnearbycount == '0' && $Businessrecommendedcount == '0') {
            return $this->errorResponse('Business not found', 403);
        }
        return $this->successResponse($Businessdata, "Business data retrieved", 200);
    }

    public function Notifications(Request $request){
        $Userdetail = auth()->user();
        //$data = $request->all();

        $record = Notification::where('target_id',$Userdetail->id)->paginate(env('PAGINATION_LIMIT'));
        if(empty($record) || count($record) == 0){
            return $this->errorResponse('No notification in your list.', 200);
        }
        return $this->successResponse($record, "Notifications getting successfully.", 200);
    }


    // pages api
    public function Page(Request $request){
        try {
            $type = $request->key;
            $cms = Page::where('slug',$type)->first();
            return response()->json([
                'status' => 'success',
                'message' => 'Get cms successfully.',
                'data' => $cms
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'error',
                'errors' =>  $e->getMessage(),
                'message'=>''
            ],500);
        }
    }

}
