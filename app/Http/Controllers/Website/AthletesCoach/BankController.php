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

        if (Auth::check()){
            $UserDetail = Auth::user();
            try {
                $curl = curl_init();

                curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.stripe.com/v1/accounts',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => 'type=express&country=US&capabilities%5Bcard_payments%5D%5Brequested%5D=true&capabilities%5Btransfers%5D%5Brequested%5D=true&email=navneetgehlotAthelitics%40gmail.com',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/x-www-form-urlencoded',
                    'Authorization: Basic c2tfdGVzdF81MUxpY0ZORmtWMjB2ejVJdkpBZDliY1Q2c015Y0VKZUQ4eGRGRzgxVXpmM2N5T0paWWphY2ZQMnNRNlJlVWRhTFlKTHNxNVZrRGhGQXRmMm9OQ2t0b2x2bTAwZ1hqTW43aUE6'
                ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);
                echo $response;
            } catch (\Throwable $th) {
                dd($th);
            }
        }else{
            return redirect()->route('web.login');
        }
    }
}
