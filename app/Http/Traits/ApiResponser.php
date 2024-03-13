<?php
namespace App\Http\Traits;

trait ApiResponser
{
    public function successResponse($data = null, $message = null, $code = 200)
    {
        if(!empty($data)){
            return response()->json([
                'status' => 'success',
                'data' => $data,
                'message' => $message,
            ], 200);
        }else{
            return response()->json([
                'status' => 'success',
                'message' => $message,
            ], 200);
        }
    }


    public function successResponsewithoutdate($message = null, $code = 200)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
        ], 200);
    }


    public function errorResponsewithoutdate($message = null, $code = 200)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
        ], 200);
    }


    public function successResponselist($list = null, $count = null, $message = null, $code = 200)
    {
        return response()->json([
            'status' => 'success',
            'list' => $list,
            'count' => $count,
            'message' => $message,
        ], 200);
    }

    public function successResponsedetail($detail = null, $message = null, $code = 200)
    {
        return response()->json([
            'status' => 'success',
            'detail' => $detail,
            'message' => $message,
        ], 200);
    }

    public function successLogoutResponse($message = null, $code = 200)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
        ], 200);
    }

    public function errorResponse($message = null, $code = 200)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
        ], 200);
    }

    public function invalidErrorResponse($message = null, $code = 200)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
        ], 200);
    }

    public function getUserDetail($user_id){
        $base_url = asset('/');
        $user = User::where('id',$user_id)->first();

        if($user->email_verified_at){
            $user->email_verified_at = $user->email_verified_at;
        }else{
            $user->email_verified_at = "";
        }

        if($user->phone_verified_at){
            $user->phone_verified_at = $user->phone_verified_at;
        }else{
            $user->phone_verified_at = "";
        }

        if($user->avatar){
            $user->avatar = $base_url.$user->avatar;
        }else{
            $user->avatar = "";
        }

        $userarray = [
            'id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'full_name' => $user->full_name,
            'email' => $user->email,
            'country_code' => $user->country_code,
            'phone' => $user->phone,
            'email_verified_at' => $user->email_verified_at,
            'phone_verified_at' => $user->phone_verified_at,
            'role' => $user->role,
            'address' => $user->address,
            'area' => $user->area,
            'city' => $user->city,
            'country' => $user->country,
            'zipcode' => $user->zipcode,
            'latitude' => $user->latitude,
            'longitude' => $user->longitude,
            'preference' => $user->preference,
            'status' => $user->status,
        ];
        return $userarray;
    }

    public function errordataResponse($data, $message = null, $code = 200)
    {
        return response()->json([
            'status' => 'error',
            'data' => $data,
            'message' => $message,
        ], 200);
    }

    public function successdataResponse($data, $message = null, $code = 200)
    {
        return response()->json([
            'status' => 'success',
            'data' => $data,
            'message' => $message,
        ], 200);
    }
}
