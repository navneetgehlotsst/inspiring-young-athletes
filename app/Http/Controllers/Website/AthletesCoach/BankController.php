<?php

namespace App\Http\Controllers\Website\AthletesCoach;

use App\Http\Controllers\Controller;
use App\Models\{
    User,
    Video,
    Subscriptions,
    Plan,
    Transaction,
    VideoHistory,
    UserIncome
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    Auth,
    DB
};
use Carbon\Carbon;
use Laravel\Cashier\Cashier;
use Laravel\Cashier\PaymentMethod;
use Laravel\Cashier\Subscription;
use Stripe;


class BankController extends Controller
{
    public function index(Request $request){

                try {
                    if (Auth::check()){
                        $UserDetail = Auth::user();
                        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

                        if (!empty($UserDetail->stripe_connect_id) && (!in_array($UserDetail->stripe_account_status, [0, 1]))) {
                            $stripe_connect_id = $UserDetail->stripe_connect_id;
                            $accResponse = $stripe->accounts->retrieve($UserDetail->stripe_connect_id, []);

                            if (!empty($accResponse) && isset($accResponse->id)) {
                                if ($accResponse->charges_enabled == true && $accResponse->payouts_enabled == true) {
                                    $response['status'] = "error";
                                    $response['message'] = "Your account is already created and payout is enabled.";
                                } else {
                                    $accLinkResponse = $stripe->accountLinks->create([
                                        'account' => $stripe_connect_id,
                                        'refresh_url' => route('web.dashboard'),
                                        'return_url' => route('web.bank.accountResponse', $accResponse->id),
                                        'type' => 'account_onboarding',
                                    ]);

                                    if (!empty($accLinkResponse) && isset($accLinkResponse->url)) {
                                        User::where('id', $UserDetail->id)->update(['stripe_account_status' => 1]);

                                        $response['status'] = "success";
                                        $response['message'] = "Please complete the account setup process.";
                                        $response['action'] = $accLinkResponse->url;

                                        return redirect($accLinkResponse->url);
                                    } else {
                                        $response['status'] = "error";
                                        $response['message'] = "Something went wrong! Account verification URL not created or missing.";
                                    }
                                }
                            } else {
                                $response['status'] = "error";
                                $response['message'] = "Oops! Something went wrong!";
                            }
                        } else {
                            $accountResponse = $stripe->accounts->create([
                                'type' => 'express',
                                'email' => $UserDetail->email,
                                'capabilities' => [
                                    'card_payments' => ['requested' => true],
                                    'transfers' => ['requested' => true],
                                ],
                                'business_type' => 'individual',
                                'individual' => [
                                    'first_name' => $UserDetail->name,
                                ],
                                'business_profile' => [
                                    'mcc' => '5816',
                                    'url' => 'www.testurl.com',
                                    'support_url' => 'www.testurl.com',
                                ],
                            ]);
                            if (!empty($accountResponse) && isset($accountResponse->id)) {
                                User::where('id', $UserDetail->id)->update(['stripe_connect_id' => $accountResponse->id]);

                                $accLinkResponse = $stripe->accountLinks->create([
                                    'account' => $accountResponse->id,
                                    'refresh_url' => route('web.dashboard'),
                                    'return_url' => route('web.bank.accountResponse', $accountResponse->id),
                                    'type' => 'account_onboarding',
                                ]);



                                if (!empty($accLinkResponse) && isset($accLinkResponse->url)) {
                                    User::where('id', $UserDetail->id)->update(['stripe_account_status' => 1]);

                                    $response['success'] = true;
                                    $response['message'] = "Please complete the account setup process.";
                                    $response['action'] = $accLinkResponse->url;

                                    return redirect($accLinkResponse->url);
                                } else {
                                    $response['success'] = false;
                                    $response['message'] = "Something went wrong! Account not created.";
                                }
                            } else {
                                $response['success'] = false;
                                $response['message'] = "Something went wrong! Account not created.";
                            }
                        }
                    }else{
                        return redirect()->route('web.login');
                    }
                } catch(\Stripe\Exception\CardException $e) {
                    $errMessage    =   $e->getMessage();
                } catch (\Stripe\Error\InvalidRequest $e) {
                    // Invalid parameters were supplied to Stripe's API
                    $errMessage    =   $e->getMessage();
                } catch (\Stripe\Error\Authentication $e) {
                    // Authentication with Stripe's API failed
                    // (maybe you changed API keys recently)
                    $errMessage    =   $e->getMessage();
                } catch (\Stripe\Error\ApiConnection $e) {
                    // Network communication with Stripe failed
                    $errMessage    =   $e->getMessage();
                } catch (\Stripe\Error\Base $e) {
                    // Display a very generic error to the user, and maybe send
                    // yourself an email
                    $errMessage    =   $e->getMessage();
                } catch (\Stripe\Exception $e) {
                    // Something else happened, completely unrelated to Stripe
                    $errMessage    =   $e->getMessage();
                }
    }


    public function accountResponse(Request $request, $accountId){
        $errMessage    =   "";

		try{
            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
			$accResponse =  $stripe->accounts->retrieve(
				$accountId,
				[]
			);
			if(!empty($accResponse) && isset($accResponse->id)){
				if($accResponse->charges_enabled == 1){
					if($accResponse->payouts_enabled == 1){
						/* update account status in babysitter */
						User::where('stripe_connect_id',$accountId)->update(array('stripe_account_status'=> 3));
						
						$payoutMsg	=	"";
					}else{
						/* update account status in babysitter */
						User::where('stripe_connect_id',$accountId)->update(array('stripe_account_status'=> 2));
						
						$payoutMsg	=	" Your account is in under review. Once it will approved your payout will settle automatically in your bank account.";
					}
					$message	=	"Payment process is completed successfully.".$payoutMsg;

                    return redirect()->route('web.dashboard')->with('success',$message);
				}else{
					$errMessage = "Your account verification process is not completed yet! No worry you can resume process from your profile.";
				}
			}else{
				$errMessage = "Opps Something went wrong!";
			}
        } catch(\Stripe\Exception\CardException $e) {
			$errMessage    =   $e->getMessage();
		} catch (\Stripe\Error\InvalidRequest $e) {
			// Invalid parameters were supplied to Stripe's API
			$errMessage    =   $e->getMessage();
		} catch (\Stripe\Error\Authentication $e) {
			// Authentication with Stripe's API failed
			// (maybe you changed API keys recently)
			$errMessage    =   $e->getMessage();
		} catch (\Stripe\Error\ApiConnection $e) {
			// Network communication with Stripe failed
			$errMessage    =   $e->getMessage();
		} catch (\Stripe\Error\Base $e) {
			// Display a very generic error to the user, and maybe send
			// yourself an email
			$errMessage    =   $e->getMessage();
		} catch (\Exception $e) {
			// Something else happened, completely unrelated to Stripe
			$errMessage    =   $e->getMessage();
		}
		
		if(empty($errMessage)){
			$errMessage = "Something went wrong!";
		}

		return Redirect::route('profileSettings')->with('error',$errMessage);
    }
}
