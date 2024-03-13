<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Mail,Hash,File,Auth,DB,Helper,Exception,Session,Redirect;
use Stripe;

class BankAccountController extends Controller
{
    
    public function checkAccount(){
        $user = Auth::user();
        $stripe_connect_id = $user->stripe_connect_id;
        if(empty($stripe_connect_id)){
            return view('web.auth.check_bank_account',compact('stripe_connect_id'));   
        }else{
            return view('web.auth.check_bank_account',compact('stripe_connect_id'));
        }
    }

    public function createAccount()
    {  
        $user  =  Auth::user();
        $errMessage    =  "";
        try{
            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
            
            // create stripe connected express account
            $accountResponse = $stripe->accounts->create([
                'type' => 'express',
                'email' => $user->email,
                'capabilities' => [
                    'card_payments' => ['requested' => true],
                    'transfers' => ['requested' => true],
                ],
                'business_type' => 'individual',
                'individual' => [
                    'full_name' => $user->full_name,
                    'email' => $user->email,
                    'phone' => '+'.$user->country_code.''.$user->phone,
                ]
            ]);
            
            dd($accountResponse);
            
            if($accountResponse){
                $user->stripe_connect_id = $accountResponse->id;
                $user->save();
                $accLinkResponse = $stripe->accountLinks->create([
                    'account' => $accountResponse->id,
                    'refresh_url' => route('bank-account.check'),
                    'return_url' => route('bank-account.response'),
                    'type' => 'account_onboarding',
                ]);

                if($accLinkResponse){
                    $account_link_url =  $accLinkResponse->url;
                    return Redirect::to($account_link_url);
                }else{
                    return redirect()->route('bank-account.check')->withError('Something went wrong!Account not created');
                }

            }else{
                return redirect()->route('bank-account.check')->withError('Something went wrong!Account not created');
            }
            
        }
        catch(\Stripe\Exception\InvalidRequestException $e) {
            $errMessage    =   $e->getMessage();
        }
        catch(\Stripe\Exception\CardException $e) {
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
        }catch(Exception $e){
            $errMessage    =   $e->getMessage();
        }

        //return redirect()->route('bank-account.check')->withError($errMessage);
    }


    public function updateAccount()
    {  
        $user  =  Auth::user();
        $errMessage    =  "";
        try{
            
            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
            $accLinkResponse = $stripe->accountLinks->create([
                'account' => $user->stripe_connect_id,
                'refresh_url' => route('bank-account.check'),
                'return_url' => route('bank-account.response'),
                'type' => 'account_onboarding',
            ]);
            
            if($accLinkResponse){
                $account_link_url =  $accLinkResponse->url;
                return Redirect::to($account_link_url);
            }else{
                return redirect()->route('bank-account.check')->withError('Something went wrong!Account not updated');
            }

        }
        catch(\Stripe\Exception\InvalidRequestException $e) {
            $errMessage    =   $e->getMessage();
        }
        catch(\Stripe\Exception\CardException $e) {
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
        }catch(Exception $e){
            $errMessage    =   $e->getMessage();
        }
        return redirect()->route('bank-account.check')->withError($errMessage);
    }

    public function accountResponse(){
        $errMessage    =   "";
        try{
            $user = Auth::user();
            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
            $user_stripe_account =  $stripe->accounts->retrieve($user->stripe_connect_id);
            if(!empty($user_stripe_account) && isset($user_stripe_account->id)){
                if($user_stripe_account->charges_enabled == 1){
                    $strip_message = "";
                    if($user_stripe_account->payouts_enabled == 1){
                        $user->stripe_account_status = 'active';
                        $user->save();
                        $strip_message = "Your bank account link successfully";
                        return Redirect::route('workspace.create')->with('success',$strip_message);
                        
                    }else{
                        $user->stripe_account_status = 'in_process';
                        $user->save();
                        $strip_message = "Your bank account verification is still incomplete.Please fill all the details and documents.";
                        return Redirect::route('bank-account.check')->with('warning',$strip_message);
                    }
                }else{
                    $errMessage = "Your bank account verification process is not completed yet!";
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
        return redirect()->route('check')->with('error',$errMessage);
    }
}
