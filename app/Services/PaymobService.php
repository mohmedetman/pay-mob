<?php

namespace App\Services;

use GuzzleHttp\Client;
use Exception;
class PaymobService
{
    protected $apiKey;
    protected $merchantId;
    protected $client;

    public function __construct()
    {
        $this->apiKey = env('PAYMOB_API_KEY');
        $this->merchantId = env('PAYMOB_MERCHANT_ID');
        $this->client = new Client();
    }

    public function authenticate()
    {
        $response = $this->client->post('https://accept.paymobsolutions.com/api/auth/tokens', [
            'json' => [
                'api_key' => $this->apiKey
            ]
        ]);

        $data = json_decode($response->getBody(), true);

        if (!isset($data['token'])) {
            throw new Exception('Unable to authenticate with Paymob');
        }

        return $data['token'];
    }
    public function registerOrder($authToken)
    {
        $response = $this->client->post('https://accept.paymobsolutions.com/api/ecommerce/orders', [
            'headers' => [
                'Authorization' => 'Bearer ' . $authToken,
            ],
            'json' => [
                'merchant_id' => $this->merchantId,
                'amount_cents' => 100, // Static amount in cents
                'currency' => 'EGP',
                'merchant_order_id' => time(), // Using current timestamp as merchant order ID
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        if (!isset($data['id'])) {
            throw new Exception('Unable to register order');
        }

        return $data;
    }
    public function getPaymentKey($authToken, $orderId)
    {
        $billingData = $this->getStaticBillingData(); // Static billing data

        $response = $this->client->post('https://accept.paymobsolutions.com/api/acceptance/payment_keys', [
            'headers' => [
                'Authorization' => 'Bearer ' . $authToken,
            ],
            'json' => [
                'amount_cents' => 10000,
                'expiration' => 3600,
                'order_id' => $orderId,
                'billing_data' => $billingData,
                'currency' => 'EGP',
                'integration_id' => 4850339
//                    env('PAYMOB_INTEGRATION_ID'),
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        if (!isset($data['token'])) {
            throw new Exception('Unable to get payment key');
        }

        return $data['token'];
    }
    private function getStaticBillingData()
    {
        return [
            "first_name" => "John",
            "last_name" => "Doe",
            "email" => "john.doe@example.com",
            "phone_number" => "01000000000",
            "apartment" => "803",
            "floor" => "42",
            "street" => "Example Street",
            "building" => "8028",
            "city" => "Cairo",
            "country" => "EG",
            "postal_code" => "01862"
        ];
    }
}
