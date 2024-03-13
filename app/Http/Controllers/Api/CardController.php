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
// use Stripe\Stripe;
// use Stripe\Customer;
use Laravel\Cashier\Cashier;
use App\Http\Controllers\StripeTrait;


class CardController extends Controller
{
    use ApiResponser;

    public function AddCard(Request $request){
        try {
            $data = $request->all();
            $validator = Validator::make($data, [
                'card_token' => 'required',
                'name' => 'required',
            ]);
            if($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' =>  $validator->errors()->first(),
                ],200);
            }
            $userid = auth()->user()->id;
            $userdetail = User::find($userid);
            if(empty($userdetail->stripe_id)){
                $stripeCustomer =  StripeTrait::createCustomer(['email' => $userdetail->email,'name' => $userdetail->full_name]);
                $stripeId = $stripeCustomer['customer_token'];
                $userdetail->stripe_id = $stripeCustomer['customer_token'];
                $userdetail->save();
            }else{
                $stripeId = $userdetail->stripe_id;
            }
            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
            $payment_method =  $stripe->paymentMethods->create([
              'type' => 'card',
              'card' => [
                'token' => $data['card_token'],
                ],
                'billing_details'=> [
                    'name' => $data['name'],
                    //'name' => 'test navn'
                ],
            ]);
            $response_data['id'] = $payment_method['id'];
            $response_data['name'] = $payment_method['billing_details']['name'];
            $response_data['brand'] = $payment_method['card']['brand'];
            $response_data['exp_month'] = $payment_method['card']['exp_month'];
            $response_data['exp_year'] = $payment_method['card']['exp_year'];
            $response_data['last4'] = $payment_method['card']['last4'];
            $usercarddata = Cashier::findBillable($stripeId);
            $paymentMethods = $usercarddata->addPaymentMethod($payment_method['id']);
            return $this->successResponse( $paymentMethods,'Card Added successfully', 200);
        } catch (TokenExpiredException $e) {
            return $this->errorResponse('Token has expired', 401);
        } catch (TokenInvalidException $e) {
            return $this->errorResponse('Token is invalid', 401);
        } catch (JWTException $e) {
            return $this->errorResponse($e->getMessage(), 401);
            return $this->errorResponse($e->getMessage(), 500);
        }
    }


    public function ListCard(Request $request){
        try{
            $authDetails = auth()->user();
            if(empty($authDetails->stripe_id)){
                return response()->json([
                    'status' => 'success',
                    'message'=>'No Payment Method Found.',
                    'strip_key' => env('STRIPE_KEY'),
                    'strip_secrete' => env('STRIPE_SECRET'),
                ],200);
            }
            $user = Cashier::findBillable($authDetails->stripe_id);
            $data = array();
            $default_card = '';
            if($user->hasPaymentMethod()) {
                $paymentMethods = $user->paymentMethods()->toArray();
                if(count($paymentMethods) > 0){
                    if($user->hasDefaultPaymentMethod()) {
                        $default =  $user->defaultPaymentMethod()->toArray();
                        if(!empty($default)){
                            $default_card = $default['id'];
                        }
                    }

                    foreach($paymentMethods as $key => $payment_method) {
                        $card['id'] = $payment_method['id'];
                        $card['name'] = $payment_method['billing_details']['name'];
                        $card['brand'] = $payment_method['card']['brand'];
                        $card['exp_month'] = $payment_method['card']['exp_month'];
                        $card['exp_year'] = $payment_method['card']['exp_year'];
                        $card['last4'] = $payment_method['card']['last4'];
                        $card['default'] = 0;
                        if($card['id'] == $default_card){
                            $card['default'] = 1;
                        }
                        array_push($data, $card);
                    }
                }

                return response()->json([
                    'status' => 'success',
                    'message'=>'All Payment Method',
                    'strip_key' => env('STRIPE_KEY'),
                    'strip_secrete' => env('STRIPE_SECRET'),
                    'data' => $data,
                ],200);
            }else{
                return response()->json([
                    'status' => 'success',
                    'message'=>'No Payment Method Found.',
                    'strip_key' => env('STRIPE_KEY'),
                    'strip_secrete' => env('STRIPE_SECRET'),
                    'data' => $data
                ],200);
            }


        }catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ],500);
        }
    }

    public function DeleteCard(Request $request){
        $data = $request->all();
        $validator = Validator::make($data, [
            'payment_method' => 'required'
        ]);
        if($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' =>  $validator->errors()->first(),
            ],200);
        }
        try{
            $authDetails = auth()->user();
            $user = Cashier::findBillable($authDetails->stripe_id);
            if($user->hasDefaultPaymentMethod()) {
                $default =  $user->defaultPaymentMethod()->toArray();
                $default_card_id = $default['id'];
                if($default_card_id == $data['payment_method']){
                    return response()->json([
                        'status' => 'error',
                        'message'=>'Cannot deleted default payment method'
                    ],200);
                }else{
                    $user->deletePaymentMethod($data['payment_method']);
                }
            }
            else{
                $user->deletePaymentMethod($data['payment_method']);
            }
            return response()->json([
                'status' => 'success',
                'message'=>'Card deleted successfully'
            ],200);
        }
        catch(Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ],500);
        }
    }

    public function addDefaultPaymentMethod(Request $request){
        $data = $request->all();
        $validator = Validator::make($data, [
            'payment_method' => 'required'
        ]);
        if($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' =>  $validator->errors()->first(),
            ],200);
        }
        try{
            $authDetails = auth()->user();
            $user = Cashier::findBillable($authDetails->stripe_id);
            $user->updateDefaultPaymentMethod($data['payment_method']);
            return response()->json([
                'status' => 'success',
                'message'=>'Dafault card updated successfully'
            ],200);
        }
        catch(Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ],500);
        }
    }

    public function GenrateCardToken(Request $request){
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
            $result = $stripe->tokens->create([
              'card' => [
                'number' => '4242424242424242',
                'exp_month' => 3,
                'exp_year' => 2024,
                'cvc' => '314',
              ],
            ]);
            echo "<pre>";
            print_r($result);
            die();
    }

}
