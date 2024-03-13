<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\GiftToken;
use App\Models\GoodWillToken;
use App\Models\TokenHistory;
use App\Models\Payment;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Str;
use App\Http\Traits\ApiResponser;
use App\Http\Controllers\StripeTrait;


class GiftTokenController extends Controller
{
    use ApiResponser;

    public function tokenCreate(Request $request){
        try {
            $data = $request->all();
            $base_url = url('/').'/';
            $data['token_code'] = strtoupper(Str::random(10));
            $commonRules = [
                'bussiness_id' => 'required|string|max:100',
                'token_amount' => 'required|string|max:100',
                //'comment' => 'sometimes',
                'type' => 'required|in:gift,goodwill',
                'card_token' => 'required'
            ];

            $typeSpecificRules = $data['type'] == 'gift'
                ? ['token_code' => 'required|unique:gift_token,token_code', 'token_validaty' => 'required|date']
                : [];

            $validator = Validator::make($data, array_merge($commonRules, $typeSpecificRules));

            if ($validator->fails()) {
                return $this->errorResponse($validator->getMessageBag()->first(), 422);
            }
            $user = JWTAuth::parseToken()->authenticate();

            $userId = $user->id;

            $GiftToken = $this->createToken($data, $userId);

            $amount = $data['token_amount'] * 100;

            $giftTokendata = GiftToken::select(
                'gift_token.id', 'gift_token.createdby', 'gift_token.shared_id','gift_token.comment','gift_token.created_at',
                'gift_token.redeem_date', 'gift_token.status', 'gift_token.token_code',
                'gift_token.token_amount', 'gift_token.token_validaty',
                'gift_token.token_shared', 'gift_token.bussiness_id', 'gift_token.hide_token',
                'businessname.business_name', 'businessname.avatar as business_image','businessname.address as full_address',
                'createdname.full_name as created_by_name',
                'createdname.phone as created_by_phone',
                'createdname.country_code as created_by_country_code',
            )
            ->join('users as businessname', 'gift_token.bussiness_id', '=', 'businessname.id')
            ->join('users as createdname', 'gift_token.createdby', '=', 'createdname.id')
            ->where('gift_token.id', $GiftToken->id)
            ->firstOrFail();

            $payment = $user->charge($amount, $data['card_token']);

            $tokenData = [
                'user_id' => $userId,
                'token_id' => $giftTokendata->id,
                'type' => $data['type'],
                'amount' => $data['token_amount'],
                'transiction_id' => $payment->id,
            ];

            Payment::create($tokenData);
            if($giftTokendata['business_image'] != ""){
                $giftTokendata['business_image'] = $base_url . $giftTokendata['business_image'];
            }else{
                $giftTokendata['business_image'] = "";
            }

            return $this->successResponse($giftTokendata, "Token created successfully", 200);
        } catch (TokenExpiredException $e) {
            return $this->errorResponse('Token has expired', 401);
        } catch (TokenInvalidException $e) {
            return $this->errorResponse('Token is invalid', 401);
        } catch (JWTException $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    private function createToken($data, $userId) {
        $tokenData = [
            'bussiness_id' => $data['bussiness_id'],
            'token_amount' => $data['token_amount'],
            'comment' => $data['comment'],
            'createdby' => $userId,
        ];

        $tokenData['token_code'] = $data['token_code'];

        if ($data['type'] == 'gift') {
            $tokenData['token_validaty'] = $data['token_validaty'];
        } else {
            $tokenData['is_goodwill'] = 1;
            $tokenData['status'] = "active";
        }
        return GiftToken::create($tokenData);
    }

    public function giftList(Request $request){
        try {
            $data = $request->all();
            $base_url = url('/').'/';
            $commonRules = [
                'type' => 'required|in:gift,goodwill,hidetoken'
            ];

            $typeSpecificRules = $data['type'] != 'hidetoken'
                ? ['status' => 'required|in:inactive,active,pending']
                : [];

            $validator = Validator::make($data, array_merge($commonRules, $typeSpecificRules));
            if ($validator->fails()) {
                return $this->errorResponse($validator->getMessageBag()->first(), 422);
            }
            $user = JWTAuth::parseToken()->authenticate();
            $userId = $user->id;

            $query = GiftToken::select(
                'gift_token.id',
                'gift_token.createdby',
                'gift_token.shared_id',
                'gift_token.redeem_date',
                'gift_token.status',
                'gift_token.token_code',
                'gift_token.comment',
                'gift_token.token_amount',
                'gift_token.created_at',
                'gift_token.token_validaty',
                'gift_token.token_shared',
                'gift_token.bussiness_id',
                'gift_token.hide_token',
                'businessname.business_name',
                'businessname.address as full_address',
                'businessname.avatar as business_image',
                'createdname.full_name as created_by_name',
                'createdname.phone as created_by_phone',
                'createdname.country_code as created_by_country_code',
                // 'sharedname.full_name as redemeed_by',
                // 'sharedname.phone as redemeed_phone'
            );

            if ($data['type'] === "gift") {
                if ($request->is_received == 1) {
                    $query->where('gift_token.shared_id', $userId);
                }else{
                    $query->where('gift_token.createdby', $userId);
                }
                $query->where('gift_token.hide_token', '0');
            } elseif ($data['type'] === "goodwill") {
                if ($request->is_received == 1) {
                    $query->where('gift_token.shared_id', $userId);
                }else{
                    $query->where('gift_token.createdby', $userId);
                }
                $query->where('gift_token.is_goodwill', 1);
                $query->where('gift_token.hide_token', '0');
            } elseif ($data['type'] === "hidetoken") {
                $query->where('gift_token.createdby', $userId)
                        ->where('gift_token.hide_token', '1');
            }
            if(!empty($data['status'])){
                $query->where('gift_token.status', $data['status']);
            }
            $query->join('users as businessname', 'gift_token.bussiness_id', '=', 'businessname.id')
            ->join('users as createdname', 'gift_token.createdby', '=', 'createdname.id');
            //->join('users as sharedname', 'gift_token.shared_id', '=', 'sharedname.id');

            $giftTokenList = $query->latest()->paginate(10);
            foreach ($giftTokenList as $key => $value) {
                if($value->shared_id != 0){
                    $Token = user::select(
                        'full_name as redemeed_by',
                        'phone as redemeed_phone'
                    )->where('id', $value->shared_id)->firstOrFail();
                    $giftTokenList[$key]['redemeed_by'] = $Token->redemeed_by;
                    $giftTokenList[$key]['redemeed_phone'] = $Token->redemeed_phone;
                }else{
                    $giftTokenList[$key]['redemeed_by'] = "";
                    $giftTokenList[$key]['redemeed_phone'] = "";
                }
            }
            $giftTokenCount = $giftTokenList->total();

            $giftTokenList->transform(function ($item) use ($base_url) {
                $item->business_image = $item->business_image ? $base_url.$item->business_image : "";
                return $item;
            });

            if ($giftTokenCount === 0) {
                return $this->errorResponse('Gift Token not found', 403);
            }

            return $this->successResponselist($giftTokenList, $giftTokenCount, "Gift Token data retrieved", 200);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function giftDetail(Request $request){
        try {
            $data = $request->only('id');
           
            $base_url = url('/').'/';
            $validator = Validator::make($data, ['id' => 'required|numeric']);

            if ($validator->fails()) {
                return $this->errorResponse($validator->errors()->first(), 422);
            }

            $giftToken = GiftToken::select(
                    'gift_token.id', 'gift_token.createdby', 'gift_token.shared_id','gift_token.comment','gift_token.created_at',
                    'gift_token.redeem_date', 'gift_token.status', 'gift_token.token_code',
                    'gift_token.token_amount', 'gift_token.token_validaty',
                    'gift_token.token_shared', 'gift_token.bussiness_id', 'gift_token.hide_token',
                    'businessname.business_name', 'businessname.avatar as business_image','businessname.address as full_address',
                    'createdname.full_name as created_by_name',
                    'createdname.phone as created_by_phone',
                    'createdname.country_code as created_by_country_code',
                )
                ->join('users as businessname', 'gift_token.bussiness_id', '=', 'businessname.id')
                ->join('users as createdname', 'gift_token.createdby', '=', 'createdname.id')
                ->where('gift_token.id', $data['id'])
                ->first();
                if(!empty($giftToken)){
                    if($giftToken->shared_id != 0){
                        $Token = user::select(
                            'full_name as redemeed_by',
                            'phone as redemeed_phone'
                        )->where('id', $giftToken->shared_id)->firstOrFail();
                        $giftToken['redemeed_by'] = $Token->redemeed_by;
                        $giftToken['redemeed_phone'] = $Token->redemeed_phone;
                    }else{
                        $giftToken['redemeed_by'] = "";
                        $giftToken['redemeed_phone'] = "";
                    }
    
                    if($giftToken['business_image'] != ""){
                        $giftToken['business_image'] = $base_url . $giftToken['business_image'];
                    }else{
                        $giftToken['business_image'] = "";
                    }
    
                    $dataResponse['giftToken'] = $giftToken;
        
                    if ($request->has('is_received') && $request->input('is_received') == '1') {
                        $balance_amount = '0';
                        $dataResponse['gifttokenhistory'] = TokenHistory::where('token_id', $giftToken->id)->get();
                        foreach ($dataResponse['gifttokenhistory'] as $key => $value) {
                            $balance_amount += $value->amount;
                        }
                        $giftToken['balance_amount'] = $giftToken->token_amount - $balance_amount;
                    } else {
                        $dataResponse['gifttokenhistory'] = [];
                        $giftToken['balance_amount'] = '0';
                    }
                    return $this->successResponse($dataResponse, "Gift Token data retrieved", 200);
                }else{
                    return $this->errorResponse('No Record Found', 500);
                }

        } catch (JWTException $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }

        

    }

    public function giftDelete(Request $request){
        try {
            $data = $request->all();
            $validator = Validator::make($data, [
                'id' => 'required|numeric',
            ]);
            if ($validator->fails()) {
                return $this->errorResponse($validator->getMessageBag()->first(), 422);
            }
            $id = $request->id;
            $GiftTokenList = GiftToken::find($id);
            if (!$GiftTokenList) {
                return $this->errorResponse('Gift Token not found', 403);
            }
        } catch (JWTException $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
        $GiftTokenList->delete();
        return $this->successResponse($GiftTokenList, "Gift Token Delete Succesfully", 200);
    }

    public function giftHide(Request $request){
        try {
            $data = $request->all();

            $validator = Validator::make($data, [
                'id' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->errorResponse($validator->getMessageBag()->first(), 422);
            }

            $userId = auth()->user()->id;

            if($request->id == "all"){
                GiftToken::whereCreatedby($userId)->update(['hide_token'=>"0"]);

                $apiMsg = "All tokens revealed successfully.";
            }else{

                $GiftTokenList = GiftToken::whereId($request->id)->whereCreatedby($userId)->first();
                if (!$GiftTokenList) {
                    return $this->errorResponse('Gift Token not found', 403);
                }

                if($GiftTokenList->hide_token == "0"){
                    $hideTokenStatus = "1";
                    $apiMsg = "Token hide successfully.";
                }else{
                    $hideTokenStatus = "0";
                    $apiMsg = "Token revealed successfully.";
                }

                $GiftTokenList->hide_token = $hideTokenStatus;
                $GiftTokenList->save();
            }


            return $this->successResponse("", $apiMsg, 200);
        } catch (JWTException $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function giftShare(Request $request){
        try {
            $data = $request->all();
            $validator = Validator::make($data, [
                'tokenid' => 'required|numeric',
                'sharedid' => 'nullable|numeric',
            ]);
            if ($validator->fails()) {
                return $this->errorResponse($validator->getMessageBag()->first(), 422);
            }
            $tokenid = $request->tokenid;
            $sharedid = $request->sharedid;
            $GiftTokenList = GiftToken::find($tokenid);
            if (!$GiftTokenList) {
                return $this->errorResponse('Gift Token not found', 200);
            }
            if($GiftTokenList->token_shared == '1'){
                return response()->json([
                    'status' => 'error',
                    'errors' =>  '',
                    'message'=>'Gift Token Alerady Shared'
                ],200);
                return $this->sendError([], "Gift Token Alerady Shared", 200);
            }
        } catch (JWTException $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }

        if(!$sharedid){
            $GiftTokenList->update([
                'token_shared' => '1',
            ]);
        }else{
            $GiftTokenList->update([
                'shared_id' => $sharedid,
                'token_shared' => '1',
                'status' => 'Active',
            ]);
        }
        return $this->successResponse($GiftTokenList, "Gift Token Shared Succefully", 200);
    }

    public function addToken(Request $request){
        try {
            $currentDate = date('Y-m-d');
            $data = $request->all();
            $validator = Validator::make($data, [
                'token_code' => 'required|exists:gift_token',
                'sharedid' => 'required|numeric',
            ]);
            if ($validator->fails()) {
                return $this->errorResponse($validator->getMessageBag()->first(), 422);
            }
            $token_code = $request->token_code;
            $GiftTokenList = GiftToken::where('token_code',$token_code)->first();
            if (!$GiftTokenList) {
                return $this->errorResponse('Gift Token not found', 403);
            }
            
            if ($GiftTokenList->shared_id != "0" ) {
                return $this->errorResponse('Gift Token Already Activated', 403);
            }
            
            if($request->type == 'good_will' ){
                $tokenshared = GiftToken::where('shared_id',$request->sharedid)->whereDate('updated_at',$currentDate)->first();
                if(!empty($tokenshared)){
                    return $this->errorResponse('You have already added a token for today. Please try again tomorrow  for this token.', 200);
                }
            }

            $tokenid = $GiftTokenList->id;

            $record = GiftToken::find($tokenid);
            $record->shared_id = $request->sharedid;
            $record->status = "Active";
            $record->save();

            return $this->successResponse($GiftTokenList, "Token added successfully", 200);

        } catch (JWTException $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
}
