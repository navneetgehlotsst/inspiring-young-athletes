<?php 

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use Helper;
use DB;
Use App\Models\Bid;
use App\Http\Controllers\ApiTrait;

trait StripeTrait {
    public static function getErrorMessage($e) {
        $body = $e->getJsonBody();
     //  dd($body);
        $err  = $body['error'];

        return $err;
    }
    /**
     * 
     * Create new card in existing customer
     */
    public static function addCardForExistingCustomer($data) {

        $curl = new \Stripe\HttpClient\CurlClient();
        $curl->setEnablePersistentConnections(false);
        \Stripe\ApiRequestor::setHttpClient($curl);

        \Stripe\Stripe::setApiKey('sk_test_51LicFNFkV20vz5IvJAd9bcT6sMycEJeD8xdFG81Uzf3cyOJZYjacfP2sQ6ReUdaLYJLsq5VkDhFAtf2oNCktolvm00gXjMn7iA');
        $response_data = [];

        $response_data['message'] = "Something went wrong! Please try again later.";
       // dd($data);
        if($data['stripeToken'] != "") {
            try{
                $card = \Stripe\Customer::createSource(
                    $data['customer'],
                    [
                        'source' => $data['stripeToken'],
                    ]
                );
                
            
                $response_data['message'] = "";
                $response_data['card_token'] = $card->id;
                $response_data['brand'] = $card->brand;
                $response_data['exp_month'] = $card->exp_month;
                $response_data['exp_year'] = $card->exp_year;
                $response_data['last4'] = $card->last4;
                $response_data['customer_token'] = $data['customer'];
               // dd($response_data);
            }
            catch(\Stripe\Exception\CardException $e) {
                return self::getErrorMessage($e);
            } 
            catch (\Stripe\Exception\RateLimitException $e) {
                $response_data['message'] = self::getErrorMessage($e);
            } 
            catch (\Stripe\Exception\InvalidRequestException $e) {
                $response_data['message'] = self::getErrorMessage($e);
            } 
            catch (\Stripe\Exception\AuthenticationException $e) {
                $response_data['message'] = self::getErrorMessage($e);
            } 
            catch (\Stripe\Exception\ApiConnectionException $e) {
                $response_data['message'] = self::getErrorMessage($e);
            } 
            catch (\Stripe\Exception\ApiErrorException $e) {
                $response_data['message'] = self::getErrorMessage($e);
            } 
            catch (Exception $e) {
                $response_data['message'] = self::getErrorMessage($e);
            }
        }
        
        
    
        return $response_data;
    }


    public static function createCustomer($data = []) {

        $response_data = [];
        $curl = new \Stripe\HttpClient\CurlClient();
        $curl->setEnablePersistentConnections(false);
        \Stripe\ApiRequestor::setHttpClient($curl);

        \Stripe\Stripe::setApiKey('sk_test_51LicFNFkV20vz5IvJAd9bcT6sMycEJeD8xdFG81Uzf3cyOJZYjacfP2sQ6ReUdaLYJLsq5VkDhFAtf2oNCktolvm00gXjMn7iA');
        try{  

    
            
            $customer = \Stripe\Customer::create(
                [
                    "email" => $data['email'],
                    "name" => $data['name'],
                    ]
                );
              
            $response_data['customer_token'] = $customer->id;
        } 
        catch(\Stripe\Exception\CardException $e) {            
            $response_data['message'] = self::getErrorMessage($e);
        } 
        catch (\Stripe\Exception\RateLimitException $e) {
            $response_data['message'] = self::getErrorMessage($e);
        } 
        catch (\Stripe\Exception\InvalidRequestException $e) {
            $response_data['message'] = self::getErrorMessage($e);
        } 
        catch (\Stripe\Exception\AuthenticationException $e) {
            $response_data['message'] = self::getErrorMessage($e);
        } 
        catch (\Stripe\Exception\ApiConnectionException $e) {
            $response_data['message'] = self::getErrorMessage($e);
        } 
        catch (\Stripe\Exception\ApiErrorException $e) {
            $response_data['message'] = self::getErrorMessage($e);
        } 
        catch (Exception $e) {
            $response_data['message'] = self::getErrorMessage($e);
        }

        return $response_data;
    }

    
    /**
     * Create Custom Account in stripe
     */
    public static function createAccount($data = []) {

        $response_data = [];
        \Stripe\Stripe::setApiKey('sk_test_51LicFNFkV20vz5IvJAd9bcT6sMycEJeD8xdFG81Uzf3cyOJZYjacfP2sQ6ReUdaLYJLsq5VkDhFAtf2oNCktolvm00gXjMn7iA');
        try{            
            $account = \Stripe\Account::create(
                [
                    "type" => "custom",
                    "country" => $data['country'],
                    "email" => $data['email'],
                    "requested_capabilities" => ['card_payments','transfers'],
                    "business_type" => "individual",
                    "individual[first_name]" => $data['firstname'],
                    "individual[last_name]" => $data['lastname'],
                    "individual[phone]" => $data['phone'],
                    "individual[dob][month]" => $data['dob_month'],
                    "individual[dob][day]" => $data['dob_day'],
                    "individual[dob][year]" => $data['dob_year'],
                    "individual[id_number]" => $data['id_number'],
                    //"individual[ssn_last_4]" => $data['security_number'],
                    "individual[address][line1]" => $data['address_line1'],
                    "individual[address][line2]" => $data['address_line2'],
                    "individual[address][postal_code]" => $data['postal_code'],
                    "individual[address][city]" => $data['city'],
                    "individual[address][state]" => $data['state'],
                    "individual[address][country]" => $data['country'],
                    "individual[email]" => $data['email'],
                    "individual[verification][document][front]" => $data['file_id'],
                    "business_profile[url]" => $data['business_url'],
                    "business_profile[mcc]" => $data['business_mcc'],
                    "tos_acceptance[date]" => time(),
                    "tos_acceptance[ip]" => $data['user_ip'],
                    "external_account" => $data['external_account'],
                ]
            );

            // echo "<pre>";
            // print_r($account);
            // die();
            $response_data['message'] = "";
            $response_data['account_token'] = $account->id;            
            $response_data['bank_account_token'] = $account->external_accounts['data'][0]->id;
            $response_data['account_holder_name'] = $account->external_accounts['data'][0]->account_holder_name;
            $response_data['bank_name'] = $account->external_accounts['data'][0]->bank_name;
            $response_data['last4'] = $account->external_accounts['data'][0]->last4;
            $response_data['routing_number'] = $account->external_accounts['data'][0]->routing_number;
        }         
        catch(\Stripe\Exception\CardException $e) {            
            $response_data['message'] = self::getErrorMessage($e);
        } 
        catch (\Stripe\Exception\RateLimitException $e) {
            $response_data['message'] = self::getErrorMessage($e);
        } 
        catch (\Stripe\Exception\InvalidRequestException $e) {
            $response_data['message'] = self::getErrorMessage($e);
        } 
        catch (\Stripe\Exception\AuthenticationException $e) {
            $response_data['message'] = self::getErrorMessage($e);
        } 
        catch (\Stripe\Exception\ApiConnectionException $e) {
            $response_data['message'] = self::getErrorMessage($e);
        } 
        catch (\Stripe\Exception\ApiErrorException $e) {
            $response_data['message'] = self::getErrorMessage($e);
        } 
        catch (Exception $e) {
            $response_data['message'] = self::getErrorMessage($e);
        }
        return $response_data;
    }    

    /**
     * Create File
     */
    public static function createFile($data = []) {
        $response_data = [];
        $curl = new \Stripe\HttpClient\CurlClient();
        $curl->setEnablePersistentConnections(false);
        \Stripe\ApiRequestor::setHttpClient($curl);

        \Stripe\Stripe::setApiKey('sk_test_51LicFNFkV20vz5IvJAd9bcT6sMycEJeD8xdFG81Uzf3cyOJZYjacfP2sQ6ReUdaLYJLsq5VkDhFAtf2oNCktolvm00gXjMn7iA');
        try{
            $file = \Stripe\File::create(
                [
                    "file" => $data['file'],
                    "purpose" => $data['purpose'],
                ]
            );

            $response_data['message'] = "";
            $response_data['file_token'] = $file->id;
        } 

        catch(\Stripe\Exception\CardException $e) {       
            $response_data['message'] = self::getErrorMessage($e);
        } 
        catch (\Stripe\Exception\RateLimitException $e) {
            $response_data['message'] = self::getErrorMessage($e);
        } 
        catch (\Stripe\Exception\InvalidRequestException $e) {
            $response_data['message'] = self::getErrorMessage($e);
        } 
        catch (\Stripe\Exception\AuthenticationException $e) {
            $response_data['message'] = self::getErrorMessage($e);
        } 
        catch (\Stripe\Exception\ApiConnectionException $e) {
            $response_data['message'] = self::getErrorMessage($e);
        } 
        catch (\Stripe\Exception\ApiErrorException $e) {
            $response_data['message'] = self::getErrorMessage($e);
        } 
        catch (Exception $e) {
            $response_data['message'] = self::getErrorMessage($e);
        }

        // print_r($response_data);
        // die;


        return $response_data;
    }
    
    /**
     * Get Stripe Fees
     */
    public static function getBalanceTransaction($txn_id) {
        $response_data = [];
        $curl = new \Stripe\HttpClient\CurlClient();
        $curl->setEnablePersistentConnections(false);
        \Stripe\ApiRequestor::setHttpClient($curl);

        \Stripe\Stripe::setApiKey('sk_test_51LicFNFkV20vz5IvJAd9bcT6sMycEJeD8xdFG81Uzf3cyOJZYjacfP2sQ6ReUdaLYJLsq5VkDhFAtf2oNCktolvm00gXjMn7iA');
        try{            
            $transaction = \Stripe\BalanceTransaction::retrieve($txn_id);            
            $response_data['message'] = "";
            $response_data['stripe_fees'] = $transaction->fee;
        } 
        catch(\Stripe\Exception\CardException $e) {            
            $response_data['message'] = self::getErrorMessage($e);
        } 
        catch (\Stripe\Exception\RateLimitException $e) {
            $response_data['message'] = self::getErrorMessage($e);
        } 
        catch (\Stripe\Exception\InvalidRequestException $e) {
            $response_data['message'] = self::getErrorMessage($e);
        } 
        catch (\Stripe\Exception\AuthenticationException $e) {
            $response_data['message'] = self::getErrorMessage($e);
        } 
        catch (\Stripe\Exception\ApiConnectionException $e) {
            $response_data['message'] = self::getErrorMessage($e);
        } 
        catch (\Stripe\Exception\ApiErrorException $e) {
            $response_data['message'] = self::getErrorMessage($e);
        } 
        catch (Exception $e) {
            $response_data['message'] = self::getErrorMessage($e);
        }
        return $response_data;
    }

    /**
     * Create Refund
     */
    public static function createRefund($charge_id) {
        $response_data = [];
        $curl = new \Stripe\HttpClient\CurlClient();
        $curl->setEnablePersistentConnections(false);
        \Stripe\ApiRequestor::setHttpClient($curl);

        \Stripe\Stripe::setApiKey('sk_test_51LicFNFkV20vz5IvJAd9bcT6sMycEJeD8xdFG81Uzf3cyOJZYjacfP2sQ6ReUdaLYJLsq5VkDhFAtf2oNCktolvm00gXjMn7iA');
        try{            
            $refund = \Stripe\Refund::create(
                [
                    "charge" => $charge_id,
                    "reason" => "requested_by_customer",
                    "reverse_transfer" => true,                    
                ]
            );
            $response_data['message'] = "";
            $response_data['refund_token'] = $refund->id;
        } 
        catch(\Stripe\Exception\CardException $e) {            
            $response_data['message'] = self::getErrorMessage($e);
        } 
        catch (\Stripe\Exception\RateLimitException $e) {
            $response_data['message'] = self::getErrorMessage($e);
        } 
        catch (\Stripe\Exception\InvalidRequestException $e) {
            $response_data['message'] = self::getErrorMessage($e);
        } 
        catch (\Stripe\Exception\AuthenticationException $e) {
            $response_data['message'] = self::getErrorMessage($e);
        } 
        catch (\Stripe\Exception\ApiConnectionException $e) {
            $response_data['message'] = self::getErrorMessage($e);
        } 
        catch (\Stripe\Exception\ApiErrorException $e) {
            $response_data['message'] = self::getErrorMessage($e);
        } 
        catch (Exception $e) {
            $response_data['message'] = self::getErrorMessage($e);
        }
        return $response_data;
    }

    /**
     * Create Custom Account in stripe
     */
    public static function updateAccount($data = []) {
        $response_data = [];
        $curl = new \Stripe\HttpClient\CurlClient();
        $curl->setEnablePersistentConnections(false);
        \Stripe\ApiRequestor::setHttpClient($curl);

        \Stripe\Stripe::setApiKey('sk_test_51LicFNFkV20vz5IvJAd9bcT6sMycEJeD8xdFG81Uzf3cyOJZYjacfP2sQ6ReUdaLYJLsq5VkDhFAtf2oNCktolvm00gXjMn7iA');
        try{            
            $account = \Stripe\Account::update(
                $data['custom_account_id'],
                [
                    // "type" => "custom",
                    // "country" => $data['country'],
                    "email" => $data['email'],
                    "requested_capabilities" => ['card_payments','transfers'],
                    "business_type" => "individual",
                    "individual[first_name]" => $data['firstname'],
                    "individual[last_name]" => $data['lastname'],
                    "individual[phone]" => $data['phone'],
                    "individual[dob][month]" => $data['dob_month'],
                    "individual[dob][day]" => $data['dob_day'],
                    "individual[dob][year]" => $data['dob_year'],
                    "individual[id_number]" => $data['id_number'],
                    //"individual[ssn_last_4]" => $data['security_number'],//
                    "individual[address][line1]" => $data['address_line1'],
                    "individual[address][line2]" => $data['address_line2'],
                    "individual[address][postal_code]" => $data['postal_code'],
                    "individual[address][city]" => $data['city'],
                    "individual[address][state]" => $data['state'],
                    "individual[address][country]" => $data['country'],
                    "individual[email]" => $data['email'],
                    // "individual[verification][document][front]" => $data['file_id'],
                    "business_profile[url]" => $data['business_url'],
                    "business_profile[mcc]" => $data['business_mcc'],
                    "tos_acceptance[date]" => time(),
                    "tos_acceptance[ip]" => $data['user_ip'],
                    "external_account" => $data['external_account'],
                ]
            );


            // echo "<pre>";
            // print_r($data);
            // die;




         $response_data['account_holder_name'] = $account->external_accounts['data'][0]->account_holder_name;
                   $response_data['bank_name'] = $account->external_accounts['data'][0]->bank_name;
                   $response_data['last4'] = $account->external_accounts['data'][0]->last4;
                   $response_data['routing_number'] = $account->external_accounts['data'][0]->routing_number;
                   $response_data['added_on'] = "23 Mar 2023 10:38 AM";
            $response_data['country'] = $data['country'];
            $response_data['address_line1'] = $data['address_line1'];
            $response_data['address_line2'] = $data['address_line2'];
            $response_data['postal_code'] = $data['postal_code'];
            $response_data['city'] = $data['city'];
            $response_data['state'] = $data['state'];
            $response_data['id_number'] = $data['id_number'];
            $response_data['account_number'] = $data['account_number_send'];
            $response_data['custom_account_id'] = $data['custom_account_id'];

               $response_data['account_token'] = $account->id;            
            $response_data['bank_account_token'] = $account->external_accounts['data'][0]->id;

        
        }         
        catch(\Stripe\Exception\CardException $e) {            
            $response_data['message'] = self::getErrorMessage($e);            
        }         
        catch (\Stripe\Exception\RateLimitException $e) {
            $response_data['message'] = self::getErrorMessage($e);
        } 
        catch (\Stripe\Exception\InvalidRequestException $e) {
            $response_data['message'] = self::getErrorMessage($e);
        } 
        catch (\Stripe\Exception\AuthenticationException $e) {
            $response_data['message'] = self::getErrorMessage($e);
        } 
        catch (\Stripe\Exception\ApiConnectionException $e) {
            $response_data['message'] = self::getErrorMessage($e);
        } 
        catch (\Stripe\Exception\ApiErrorException $e) {
            $response_data['message'] = self::getErrorMessage($e);
        } 
        catch (Exception $e) {
            $response_data['message'] = self::getErrorMessage($e);
        }
        return $response_data;
    }

    /**
     * Delete Custom Account in stripe
     */
    public static function deleteAccount($data = []) {
        $response_data = [];
        $curl = new \Stripe\HttpClient\CurlClient();
        $curl->setEnablePersistentConnections(false);
        \Stripe\ApiRequestor::setHttpClient($curl);

        // \Stripe\Stripe::setApiKey('sk_test_51LicFNFkV20vz5IvJAd9bcT6sMycEJeD8xdFG81Uzf3cyOJZYjacfP2sQ6ReUdaLYJLsq5VkDhFAtf2oNCktolvm00gXjMn7iA');
        try{            
            // $account = \Stripe\Account::delete(
            //     $data['custom_account_id'],
            //     []
            // );
            $stripe = new \Stripe\StripeClient(
                'sk_test_51LicFNFkV20vz5IvJAd9bcT6sMycEJeD8xdFG81Uzf3cyOJZYjacfP2sQ6ReUdaLYJLsq5VkDhFAtf2oNCktolvm00gXjMn7iA'
            );
            $stripe->accounts->delete(
                $data['custom_account_id'],
                []
            );
        }         
        catch(\Stripe\Exception\CardException $e) {            
            $response_data['message'] = self::getErrorMessage($e);            
        }         
        catch (\Stripe\Exception\RateLimitException $e) {
            $response_data['message'] = self::getErrorMessage($e);
        } 
        catch (\Stripe\Exception\InvalidRequestException $e) {
            $response_data['message'] = self::getErrorMessage($e);
        } 
        catch (\Stripe\Exception\AuthenticationException $e) {
            $response_data['message'] = self::getErrorMessage($e);
        } 
        catch (\Stripe\Exception\ApiConnectionException $e) {
            $response_data['message'] = self::getErrorMessage($e);
        } 
        catch (\Stripe\Exception\ApiErrorException $e) {
            $response_data['message'] = self::getErrorMessage($e);
        } 
        catch (Exception $e) {
            $response_data['message'] = self::getErrorMessage($e);
        }
        return $response_data;
    }
    
    
    
    
    
        public static function deleteCardForExistingCustomer($data = []) {
        
        
        
        $response_data = [];

        $response_data['message'] = "Something went wrong! Please try again later.";
        if($data['stripeToken'] != "") {
            try{
                
                $stripe = new \Stripe\StripeClient('sk_test_51LicFNFkV20vz5IvJAd9bcT6sMycEJeD8xdFG81Uzf3cyOJZYjacfP2sQ6ReUdaLYJLsq5VkDhFAtf2oNCktolvm00gXjMn7iA');
                $stripe->customers->deleteSource($data['customer'], $data['stripeToken'],[]);
                        $response_data['message'] = "Card deleted successfully.";
            }
            catch(\Stripe\Exception\CardException $e) {
                $response_data['message'] = self::getErrorMessage($e);
            } 
            catch (\Stripe\Exception\RateLimitException $e) {
                $response_data['message'] = self::getErrorMessage($e);
            } 
            catch (\Stripe\Exception\InvalidRequestException $e) {
                $response_data['message'] = self::getErrorMessage($e);
            } 
            catch (\Stripe\Exception\AuthenticationException $e) {
                $response_data['message'] = self::getErrorMessage($e);
            } 
            catch (\Stripe\Exception\ApiConnectionException $e) {
                $response_data['message'] = self::getErrorMessage($e);
            } 
            catch (\Stripe\Exception\ApiErrorException $e) {
                $response_data['message'] = self::getErrorMessage($e);
            } 
            catch (Exception $e) {
                $response_data['message'] = self::getErrorMessage($e);
            }
        }
        
        return $response_data;


}
    
    
   

     public function acceptbooking(Request $request)
    {
$booking_details = $this->bookingDetails($request->id ?? '');
 $user_id = $booking_details->user_id;

$result= Helper::user_details($user_id);



       $booking_exits =  DB::table('booking')->where('id',$request->id)->count();

       if ($booking_exits > 0) {

        if($request->is_cancel == 3){

      $validator = Validator::make($request->all(), [
                        'id' => 'required',
                        ]);
                        if ($validator->fails()) 
                        {
                        return response()->json([
                        'status' => false,
                        'message' => $validator->messages()->first()
                        ]);
                        }

                        $tutor_details =   $this->booking_details_payment($request->id);

                        if(empty($tutor_details)){

                        return response()->json([
                        'status' => false,
                        //'message' => "Please Add Bank detials First."
                        'message' => "Stripe Details Not Available."
                        ]);   
                        }

                        $tutor_details->amount*100;
                        $response_data = [];
                        \Stripe\Stripe::setApiKey('sk_test_51LicFNFkV20vz5IvJAd9bcT6sMycEJeD8xdFG81Uzf3cyOJZYjacfP2sQ6ReUdaLYJLsq5VkDhFAtf2oNCktolvm00gXjMn7iA');
                        try{  
                        $destination=  $tutor_details->custom_account_id ?? '';
                        $data1['is_cancel']=$request->is_cancel;
                        $charge = \Stripe\Transfer::create(array(
                        "amount" => $tutor_details->amount*100,
                        "currency" => "aud",
                        "destination" => $destination,
                        ));

                        $insert_data = DB::table('booking')->where('id',$request->id)->update($data1);
                        DB::table('booking_item')->where('booking_id',$request->id)->update($data1);
                        $payment['booking_id']=$tutor_details->id;
                        $payment['user_id']=$tutor_details->user_id ?? NULL;
                        $payment['tutor_id']=$tutor_details->tutor_id ?? NULL;
                        $payment['customer_token']=$tutor_details->customer_token ?? NULL;
                        $payment['card_token']=$tutor_details->card_token ?? NULL;
                        $payment['charge_token']=$charge['charge_token'] ?? NULL;
                        $payment['balance_transaction']=$charge['balance_transaction'] ?? NULL;
                        $payment['transfer_token']=$charge['transfer_token'] ?? NULL;
                        $payment['amount']=$tutor_details->amount ?? NULL;
                        $insert = DB::table('payments')->insert($payment);

                        if(!empty($result->push_token)){

                        $msg ='Booking Accept Successfully';
                        $ID =$request->id;
                        $sendNotification = $this->sendNotification($result->push_token,$result->device_type,$msg,"Booking",$ID);

                        }

                        else{

                        $msg ='';
                        }


                        return response()->json(['status' => true,'message' => 'Booking Completed Successfully.','data'=>NULL]); 
                        }

                        catch(\Stripe\Exception\CardException $e) {            
                        $response_data['message'] = self::getErrorMessage($e);            
                        }         
                        catch (\Stripe\Exception\RateLimitException $e) {
                        $response_data['message'] = self::getErrorMessage($e);
                        } 
                        catch (\Stripe\Exception\InvalidRequestException $e) {
                        $response_data['message'] = self::getErrorMessage($e);
                        } 
                        catch (\Stripe\Exception\AuthenticationException $e) {
                        $response_data['message'] = self::getErrorMessage($e);
                        } 
                        catch (\Stripe\Exception\ApiConnectionException $e) {
                        $response_data['message'] = self::getErrorMessage($e);
                        } 
                        catch (\Stripe\Exception\ApiErrorException $e) {
                        $response_data['message'] = self::getErrorMessage($e);
                        } 
                        catch (Exception $e) {
                        $response_data['message'] = self::getErrorMessage($e);
                        }

                        return $this->responseError($response_data['message'], $this->emptyObj);
        }




                if($request->is_cancel == 1){

                            $data1['is_cancel']=$request->is_cancel;
                     
                            $insert_data = DB::table('booking')->where('id',$request->id)->update($data1);
                            DB::table('booking_item')->where('booking_id',$request->id)->update($data1);

                                   if(!empty($result->push_token)){

                                    $msg ='Booking Accept Successfully';
                                    $ID =$request->id;
                                    $sendNotification = $this->sendNotification($result->push_token,$result->device_type,$msg,"Booking",$ID);
                                    }

                                    else{
                                    $msg ='';
                                    }
                        return response()->json(['status' => true,'message' => 'Booking Accept Successfully.','data'=>NULL]); 
                }
                  


}

else{

   
          return response()->json(['status' => true,'message' => 'Booking Not Found.','data'=>NULL]);   
}

               // return response()->json(['status' => true,'message' => 'Booking Accept Successfully.']); 
} 
    

    public function booking_details_payment($id){



    $details = DB::table('booking')
            ->join('user_bank_accounts', 'booking.tutor_id', '=', 'user_bank_accounts.user_id')
            ->select('booking.*', 'user_bank_accounts.custom_account_id')
            ->where('booking.id',$id)
            ->where('user_bank_accounts.status',"status")
            ->first();


}



    public function bookingDetails($id){

      return DB::table('booking')->where('id',$id)->first();


    }

    public function cancelbooking(Request $request){
        
        $name =  auth()->user()->name;
$booking_details = $this->bookingDetails($request->id ?? '');
 $user_id = $booking_details->user_id ?? '';
$result= Helper::user_details($user_id);
       $booking_exits =  DB::table('booking')->where('id',$request->id)->count();

       if ($booking_exits > 0) {
           
         $adminCharge = $this->adminCharge();
           $percentage =  $adminCharge->value;
            $validator = Validator::make($request->all(), [
        'id' => 'required',
        'cancel_reason' => 'required'
        ]);
            if ($validator->fails()) 
            {
                return response()->json([
                'status' => false,
                'message' => $validator->messages()->first()
                ]);
            }

        $response_data = [];
        \Stripe\Stripe::setApiKey('sk_test_51LicFNFkV20vz5IvJAd9bcT6sMycEJeD8xdFG81Uzf3cyOJZYjacfP2sQ6ReUdaLYJLsq5VkDhFAtf2oNCktolvm00gXjMn7iA');

        try{  

            $details = $this->booking_details_custumerpayment($request->id);

            $totalWidth = $details->amount ?? NULL;

$new_amount = ($percentage / 100) * $totalWidth;


            if($details->charge_token != "") {

            $data1['cancel_reason']=$request->cancel_reason;
            $data1['cancel_by']=$request->cancel_by;
            $data1['is_cancel']="2";
                $refund = \Stripe\Refund::create([
                'charge' => $details->charge_token,
                'amount' => $new_amount*100,  // For 10 $
                'reason' => 'requested_by_customer'
                ]);
                }   

            $insert_data = DB::table('booking')->where('id',$request->id)->update($data1);
            DB::table('booking_item')->where('booking_id',$request->id)->update($data1);
                if(!empty($result->push_token)){
                      $result->push_token;
                     
                 
$msg ="$name, has cancelled your booking";
$ID =$request->id;
$sendNotification = $this->sendNotification($result->push_token,$result->device_type,$msg,"Booking",$ID);

}

else{
$msg ='';
}


                  return response()->json(['status' => true,'message' => 'Booking Cancel Successfully.','data'=>NULL]);  
            
        
        }         
        catch(\Stripe\Exception\CardException $e) {            
            $response_data['message'] = self::getErrorMessage($e);            
        }         
        catch (\Stripe\Exception\RateLimitException $e) {
            $response_data['message'] = self::getErrorMessage($e);
        } 
        catch (\Stripe\Exception\InvalidRequestException $e) {
            $response_data['message'] = self::getErrorMessage($e);
        } 
        catch (\Stripe\Exception\AuthenticationException $e) {
            $response_data['message'] = self::getErrorMessage($e);
        } 
        catch (\Stripe\Exception\ApiConnectionException $e) {
            $response_data['message'] = self::getErrorMessage($e);
        } 
        catch (\Stripe\Exception\ApiErrorException $e) {
            $response_data['message'] = self::getErrorMessage($e);
        } 
        catch (Exception $e) {
            $response_data['message'] = self::getErrorMessage($e);
        }

 return $this->responseError($response_data['message'], $this->emptyObj);
       }

       else{

          return response()->json(['status' => true,'message' => 'Booking Not Found.','data'=>NULL]);  
       }



}




    public function booking_details_custumerpayment($id){

// echo $id;
// die;

   return $details = DB::table('booking')
            ->join('admin_payments', 'booking.id', '=', 'admin_payments.booking_id')
            ->select('booking.*', 'admin_payments.charge_token')
            ->where('booking.id',$id)
            ->first();

}
    
   


   public function adminCharge(){
    return DB::table('setting')->first();
   } 
    


                  public function sendNotification($token,$device_type,$msg,$type,$id) {
                      
              

         
                $url = 'https://fcm.googleapis.com/fcm/send';
                $notification = [
            'title' =>'Booking Status ',
            'type' =>$type,
            'id' =>$id,
            'body' => $msg

        ];
        
                 if($device_type == "android"){
                 
    //                  $fields = array (
    //           'to' => $registatoin_ids,
    //         'data' => array (
    //                 "message" => $notification
    //         )
    // );
    
                $fields = array (
            'registration_ids' => array ($token),
            'data' => array (
                    "message" => $notification
            )
    );
    
    
    
    
      } else {
          
    //           $fields = array (
    //         'registration_ids' => array ($token),
    //         'notification' => array (
    //                 "message" => $notification
    //         )
    // );
    
          
  
        $fields = array (
                'registration_ids' => array ($token),
                'notification'=>$notification
                );
    
    
      }

    // $fields = array (
    //         'registration_ids' => array ($token),
    //         'data' => array (
    //                 "message" => $notification
    //         )
    // );
    $fields = json_encode ( $fields );
    $headers = array ('Authorization: key=' . "AAAAFWliTl8:APA91bEzivGuzg-QUaUbxVmaS7Bu0TOobR1bKgBtc5g-F0vsNmCbxka7fb48jsZdGb97n1FhlgQHIVb6E70gnXqdi2WfKZCxAW15sJ2J-q7YujBdILsj6T8IqrVfeqWZfPqTuogKE68_",
      'Content-Type: application/json'
    );

    $ch = curl_init ();
    curl_setopt ( $ch, CURLOPT_URL, $url );
    curl_setopt ( $ch, CURLOPT_POST, true );
    curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
    curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );

    $result = curl_exec ( $ch );
             
                      
     $result;
    
    
    
}

public static function createCharge($data = []) {

    $response_data = [];
    try{      
        
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $charge =  $stripe->charges->create([
            'amount' => $data['amount'] * 100,
            'currency' => env('CURRENCY'),
            'source' => $data['card_token'],
            'description' => 'Payment for '.$data['plan'].' Plan.',
            'capture' => true,
            //'transfer_data' => ['destination' => $data['stripe_id'], 'amount' => $data['amount']*100],
        ]); 
        
        $response_data['message'] = "";
        $response_data['charge_token'] = $charge->id;
        $response_data['balance_transaction'] = $charge->balance_transaction;
        $response_data['transfer_token'] = $charge->transfer;

    } 
    catch(\Stripe\Exception\CardException $e) {            
        $response_data['message'] = self::getErrorMessage($e);
    } 
    catch (\Stripe\Exception\RateLimitException $e) {
        $response_data['message'] = self::getErrorMessage($e);
    } 
    catch (\Stripe\Exception\InvalidRequestException $e) {
        $response_data['message'] = self::getErrorMessage($e);
    } 
    catch (\Stripe\Exception\AuthenticationException $e) {
        $response_data['message'] = self::getErrorMessage($e);
    } 
    catch (\Stripe\Exception\ApiConnectionException $e) {
        $response_data['message'] = self::getErrorMessage($e);
    } 
    catch (\Stripe\Exception\ApiErrorException $e) {
        $response_data['message'] = self::getErrorMessage($e);
    } 
    catch (Exception $e) {
        $response_data['message'] = self::getErrorMessage($e);
    }

    return $response_data;
}


public static function TokencreateCharge($data = []) {

    $response_data = [];
    try{      
        
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $charge =  $stripe->charges->create([
            'amount' => $data['amount'] * 100,
            'currency' => env('CURRENCY'),
            'source' => $data['card_token'],
            //'payment_method_types' => ['card'],
            // 'description' => 'Payment for Token.',
            'capture' => true,
            //'transfer_data' => ['destination' => $data['stripe_id'], 'amount' => $data['amount']*100],
        ]); 
        
        $response_data['message'] = "";
        $response_data['charge_token'] = $charge->id;
        $response_data['balance_transaction'] = $charge->balance_transaction;
        $response_data['transfer_token'] = $charge->transfer;

    } 
    catch(\Stripe\Exception\CardException $e) {            
        $response_data['message'] = self::getErrorMessage($e);
    } 
    catch (\Stripe\Exception\RateLimitException $e) {
        $response_data['message'] = self::getErrorMessage($e);
    } 
    catch (\Stripe\Exception\InvalidRequestException $e) {
        $response_data['message'] = self::getErrorMessage($e);
    } 
    catch (\Stripe\Exception\AuthenticationException $e) {
        $response_data['message'] = self::getErrorMessage($e);
    } 
    catch (\Stripe\Exception\ApiConnectionException $e) {
        $response_data['message'] = self::getErrorMessage($e);
    } 
    catch (\Stripe\Exception\ApiErrorException $e) {
        $response_data['message'] = self::getErrorMessage($e);
    } 
    catch (Exception $e) {
        $response_data['message'] = self::getErrorMessage($e);
    }

    return $response_data;
}

}