<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\BusinessFavorite;
use App\Models\MyPlan;
use App\Models\Plan;
use App\Models\Offers;
use App\Models\GiftToken;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Traits\ApiResponser;


class BussinesController extends Controller
{
    use ApiResponser;
    public function listBusinesses(Request $request){
        try {
            $base_url = url('/').'/';
            $data = $request->all();
            $Userid = auth()->user()->id;
            $validator = Validator::make($data, [
                'search' => 'nullable',
                'featured' => 'nullable|in:1',
                'latitude' => 'nullable|numeric',
                'longitude' => 'nullable|numeric',
                'order_by' => 'nullable',
                'category' => 'nullable',
                'max_distance' => 'nullable|numeric',
                'goodwill' => 'nullable|numeric|in:1',
            ]);
            if ($validator->fails()) {
                return $this->errorResponse($validator->getMessageBag()->first(), 422);
            }
            $search = $request->search;
            $featured = $request->featured;
            $latitude = $request->latitude;
            $longitude = $request->longitude;
            $orderBy = $request->order_by;
            $category = $request->category;
            $goodwill = $request->goodwill;
            $max_distance = $request->max_distance;
            if(!empty($max_distance)){
                $distanceUnit = $max_distance;
            }else{
                $distanceUnit = 300;
            }

            $businessIds    =   [];
            if(!empty($category)){
                $catArray = explode(",",$category);
                if(!empty($catArray)){
                    foreach($catArray as $catItem){
                        $businessIdItems = User::whereRaw('FIND_IN_SET(?, category)', [$catItem])->pluck('id','id')->toArray();
                        if(!empty($businessIdItems)){
                            foreach($businessIdItems as $businessIdItem){
                                $businessIds[$businessIdItem] = $businessIdItem;
                            }

                        }
                    }
                }
            }
            //dd($businessIds);


            $query = User::select("users.id","users.first_name","users.last_name","users.about","users.category","users.full_name","users.business_name","users.email","users.country_code","users.phone","users.role","users.address","users.area","users.city","users.avatar","users.latitude","users.longitude","users.featured","users.goodwill",DB::raw("ROUND((6371 * acos(cos(radians(".$latitude."))*cos(radians(users.latitude)) *cos(radians(users.longitude) - radians(".$longitude."))+sin(radians(".$latitude."))*sin(radians(users.latitude)))),2) AS distance"));
            //$query->join('business_category', 'users.category', '=', 'business_category.id');
            $query->where('users.status','active');
            $query->where('users.role','business');
            $query->havingRaw('distance <= '.$distanceUnit);
            if($request->search != ""){
                $query->where('business_name', 'like', '%'.$search.'%');
                $query->orWhere('city', 'like', '%'.$search.'%');
            }
            if($request->featured != ""){
                $query->where('featured',$featured);
            }
            if(!empty($request->category)){
                $query->whereIn('id', $businessIds);
            }
            if($request->goodwill == "1"){
                $query->where('goodwill',$goodwill);
            }
            if($request->orderBy != ""){
                if($request->orderBy != "goodwill" && $request->orderBy != "featured" ){
                    $query->orderBy('distance',$orderBy);
                }elseif($request->orderBy == "goodwill"){
                    $query->orderByDesc('goodwill');
                }else{
                    $query->orderByDesc('featured');
                }
            }else{
                $query->orderBy('distance','desc');
            }
            //dd($query->toSql());
            $Businessresults = $query->paginate(20);
            $Businesscount = $query->count();
            if ($Businesscount == '0') {
                return $this->errorResponse('Business not found', 403);
            }
            foreach ($Businessresults as $key => $Business) {
                if($Business->avatar){
                    $Business->avatar = $base_url.$Business->avatar;
                }else{
                    $Business->avatar = "";
                }
                $BusinessFavoriteCheck = BusinessFavorite::where('user_id',$Userid)->where('bussiness_id',$Business->id)->first();
                if(!empty($BusinessFavoriteCheck)){
                    $Business->is_favorite = '1';
                }else{
                    $Business->is_favorite = '0';
                }
            }
            $Businessresults->avatar = $Business->avatar;
            $Businessresults->is_favorite = $Business->is_favorite;
            $Businessdata['List'] = $Businessresults;
            $Businessdata['count'] = $Businesscount;

            return $this->successResponselist($Businessresults,$Businesscount, "Business data retrieved", 200);
        } catch (JWTException $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
    public function detailBusinesses(Request $request){
        try {
            $base_url = url('/').'/';
            $data = $request->all();
            $validator = Validator::make($data, [
                'id' => 'required|numeric',
                'latitude' => ' numeric',
                'longitude' => 'required|numeric',
            ]);
        
            if ($validator->fails()) {
                return $this->errorResponse($validator->getMessageBag()->first(), 422);
            }
        
            $Userid = auth()->user()->id;
            $id = $data['id'];
            $latitude = $data['latitude'];
            $longitude = $data['longitude'];
            //$distanceUnit = 300;
        
            $Businessresults = User::select("users.id", "users.first_name", "users.last_name", "users.about", "users.full_name", "users.business_name", "users.email", "users.country_code", "users.phone", "users.role", "users.address", "users.area", "users.city", "users.avatar", "users.latitude", "users.longitude", "users.featured", "users.goodwill", DB::raw("6371 * acos(cos(radians(" . $latitude . "))*cos(radians(users.latitude)) *cos(radians(users.longitude) - radians(" . $longitude . "))+sin(radians(" . $latitude . "))*sin(radians(users.latitude))) AS distance"))
                ->where('users.id', $id)
                //->havingRaw('distance < ' . $distanceUnit)
                ->first();
        
            if (!$Businessresults) {
                return $this->errorResponse('Business not found', 403);
            }
        
            $BusinessFavoriteCheck = BusinessFavorite::where('user_id', $Userid)->where('bussiness_id', $id)->exists();
            $Businessresults->is_favorite = $BusinessFavoriteCheck ? '1' : '0';
            $Businessresults->avatar = $Businessresults->avatar ? $base_url . $Businessresults->avatar : "";
        
            $plan = MyPlan::where('business_id', $id)
                ->where('expiry_date', '>=', date('Y-m-d'))
                ->where('status', 'Active')
                ->orderBy('id', 'Desc')
                ->first();
        
            $offers = [];
            if ($plan && strtotime($plan->expiry_date) >= strtotime(date('Y-m-d'))) {
                $offers = Offers::where('bussiness_id', $id)
                        ->where('status', '1')
                        ->get();
            }
            $goodwilltoken = GiftToken::where('bussiness_id', $id)
                    ->where('is_goodwill','1')
                    ->where('shared_id','0')
                    ->orderBy('shared_id', 'asc')
                    ->get();
            if(empty($goodwilltoken)){
                $goodwilltoken = [];
            }

            $gifttoken = GiftToken::where('bussiness_id', $id)
                    ->where('is_goodwill','0')
                    ->where('token_shared','0')
                    ->orderBy('shared_id', 'asc')
                    ->get();
            if(empty($gifttoken)){
                $gifttoken = [];
            }
        } catch (JWTException $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
        
        $Businessdata['List'] = $Businessresults;
        $Businessdata['offers'] = $offers;
        $Businessdata['good_will_token'] = $goodwilltoken;
        $Businessdata['gift_token'] = $gifttoken;
        return $this->successResponsedetail($Businessdata, "Business data retrieved", 200);
        
    }

    public function businesseslistfavorite(Request $request){
        try {
            $base_url = url('/').'/';
            $data = $request->all();
            $Userid = auth()->user()->id;
            $validator = Validator::make($data, [
                'search' => 'nullable',
                'featured' => 'nullable|in:1',
                'latitude' => 'nullable|numeric',
                'longitude' => 'nullable|numeric',
                'orderBy' => 'nullable|in:asc,desc',
                'category' => 'nullable',
                'max_distance' => 'nullable|numeric',
                'goodwill' => 'nullable|numeric|in:1',
            ]);
            if ($validator->fails()) {
                return $this->errorResponse($validator->getMessageBag()->first(), 422);
            }
                $search = $request->search;
                $featured = $request->featured;
                $latitude = $request->latitude;
                $longitude = $request->longitude;
                $orderBy = $request->orderBy;
                $category = $request->category;
                $goodwill = $request->goodwill;
                $catarray = explode(",",$category);
                $distanceUnit = 300;
                $query = User::select("users.id","users.first_name","users.last_name","users.about","users.full_name","users.business_name","users.email","users.country_code","users.phone","users.role","users.address","users.area","users.city","users.avatar","users.latitude","users.longitude","users.featured","users.goodwill",DB::raw("6371 * acos(cos(radians(".$latitude."))*cos(radians(users.latitude)) *cos(radians(users.longitude) - radians(".$longitude."))+sin(radians(".$latitude."))*sin(radians(users.latitude))) AS distance"),'business_category.name As business_category_name');
                $query->join('business_category', 'users.category', '=', 'business_category.id');
                $query->join('business_favorite', 'users.id', '=', 'business_favorite.bussiness_id');
                $query->where('users.status','active');
                $query->where('users.role','business');
                $query->where('business_favorite.user_id',$Userid);
                $query->havingRaw('distance < '.$distanceUnit);
                if($request->search != ""){
                    $query->where('business_name', 'like', '%'.$search.'%');
                    $query->orWhere('city', 'like', '%'.$search.'%');
                }
                if($request->featured != ""){
                    $query->where('featured',$featured);
                }
                if($request->category != ""){
                    $query->where('category',$catarray);
                }
                if($request->goodwill == "1"){
                    $query->where('goodwill',$goodwill);
                }
                if($request->orderBy != ""){
                    $query->orderBy('distance',$orderBy);
                }
                $Businessresults = $query->paginate(10);
                $Businesscount = $query->count();
                if ($Businesscount == '0') {
                    return $this->errorResponse('Business not found', 403);
                }
                foreach ($Businessresults as $key => $Business) {
                    if($Business->avatar){
                        $Business->avatar = $base_url.$Business->avatar;
                    }else{
                        $Business->avatar = "";
                    }
                    $BusinessFavoriteCheck = BusinessFavorite::where('user_id',$Userid)->where('bussiness_id',$Business->id)->first();
                    if(!empty($BusinessFavoriteCheck)){
                        $Business->is_favorite = '1';
                    }else{
                        $Business->is_favorite = '0';
                    }
                }
                $Businessresults->avatar = $Business->avatar;
                $Businessdata['List'] = $Businessresults;
                $Businessdata['count'] = $Businesscount;
                return $this->successResponselist($Businessresults,$Businesscount, "Business data retrieved", 200);
            } catch (JWTException $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function addremovefavorite(Request $request){
        try {
            $data = $request->all();
            $Userid = auth()->user()->id;
            $validator = Validator::make($data, [
                'id' => 'required|numeric',
            ]);
            if ($validator->fails()) {
                return $this->errorResponse($validator->getMessageBag()->first(), 422);
            }
            $id = $request->id;
            // $BusinessFavoriteCheck = BusinessFavorite::where('user_id',$Userid)->where('bussiness_id',$Business->id)->first();
            if($id == 0){
                $recordDelete = BusinessFavorite::where('user_id',$Userid)->forceDelete();
                return $this->successResponsewithoutdate("Favorite business successfully removed.", 200);
            }else{
                $BusinessFavoriteCheck = BusinessFavorite::where('user_id',$Userid)->where('bussiness_id',$id)->first();
                if(!empty($BusinessFavoriteCheck)){
                    $BusinessFavoriteCheck = BusinessFavorite::where('user_id',$Userid)->where('bussiness_id',$id)->forceDelete();
                    return $this->successResponsewithoutdate("Favorite business successfully removed.", 200);
                }else{
                    $BusinessFavorite = new BusinessFavorite;
                    $BusinessFavorite->bussiness_id = $id;
                    $BusinessFavorite->user_id = $Userid;
                    $BusinessFavorite->save();
                    return $this->successResponsewithoutdate("Business added in favorite", 200);
                }
            }
        } catch (JWTException $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
}
