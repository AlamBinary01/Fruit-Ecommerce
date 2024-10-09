<?php

namespace App\Services;

use Square\SquareClient;
use Square\Exceptions\ApiException;
use Square\Models\CreatePaymentRequest;
use Square\Models\Money;

class SquareService
{
    protected $client;

    public function __construct()
    {
        $this->client = new SquareClient([
            'accessToken' => env('SQUARE_ACCESS_TOKEN'),
            'environment' => env('SQUARE_ENVIRONMENT') === 'production' ? 'production' : 'sandbox',
        ]);
    }

    public function processPayment($nonce, $amount)
    {
        $paymentsApi = $this->client->getPaymentsApi();

        $money = new Money();
        $money->setAmount(intval($amount * 100)); // Amount in cents
        $money->setCurrency('USD'); // Change currency if needed

        $body = new CreatePaymentRequest(
            $nonce,
            uniqid(), // idempotency key
            $money
        );

        try {
            $response = $paymentsApi->createPayment($body);
            if ($response->isSuccess()) {
                return $response->getResult();
            } else {
                return $response->getErrors();
            }
        } catch (ApiException $e) {
            return $e->getMessage();
        }
    }
}
