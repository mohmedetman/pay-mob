<?php

namespace App\Http\Controllers\Transaction;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Transaction;
use App\Models\ApiSecret;
use Illuminate\Routing\Controller;

class PaymobHandle extends Controller
{
    /**
     *
     * init payment factory
     * get request host
     * prepare request data
     * @param string $method
     * @param string $secret
     * @param string $order_id
     * @param string $item
     * @param string $amount
     * @param string $user_first_name
     * @param string $user_last_name
     * @param string $user_email
     * @param string $user_phone
     * @throws \Exception
     * @return mixed
     */
    public static function make(Request $request)
    {

        // Gather request input
        $orderId = $request->input("order_id");
        $amount = $request->input("amount");
        $full_name = $request->input("full_name");
        $user_email = $request->input("email");
        $user_phone = $request->input("phone");
        $item = $request->input("item");
        $redirect_url = $request->input("redirect_url");
        $host = $request->getHost();

        // prepare end-point urls.
        $urlPayment = 'https://accept.paymob.com/api/ecommerce/payment-links';
        $urlLogin = 'https://accept.paymob.com/api/auth/tokens';

        // get API KEY / INTEGRATION ID
        $api_key = env('PAYMOB_API_KEY');
        $pintegration = env('PAYMOB_INTEGRATION_ID_VISA');

        // check if payment is direct, installment or wallet to use the right integration ID for it.
        if ($request->has('payment_type')) {
            $type = $request->input("payment_type");
            if ($type == 'installment') {
                $pintegration = env('PAYMOB_INTEGRATION_ID_INSTALLMENT');
            } elseif ($type == 'wallet') {
                $pintegration = env('PAYMOB_INTEGRATION_ID_WALLET');
            }
        }

        // prepare request data
        $data = [
            'amount_cents' => 1 * 100,
            'currency' => 'EGP',
            'payment_methods' => [$pintegration],
            'is_live' => true,
            'full_name' => "ggege",
            'email' => "mo@gamil.com",
            'phone_number' => "01012428963"
        ];

        // doing a request for login end-point to get token.
        $loginCurl = Helper::doCurl($urlLogin, 'POST', ['api_key' => $api_key]);
        $token = $loginCurl['response']['token'];

        // send request with token to prepare payment link
        $payment = Helper::doCurl($urlPayment, 'POST', $data, ['Authorization: Bearer ' . $token]);

        // get response data
        try {
            if ($payment['status_code'] == 201) {
              dd('sucess');
            } else {
                return response()->json(['status_code' => $payment['status_code']]);
            }
        } catch(\Exception $e){
            return $e;
        }
    }

    public static function verify(Request $request)
    {
        dd($request->all());
    }
}
