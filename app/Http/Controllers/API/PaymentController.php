<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Braintree\Gateway;

class PaymentController extends Controller
{
    public function generateClientToken()
    {
        $gateway = new Gateway([
            'environment' => env('BRAINTREE_ENV'),
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY'),
        ]);


        $clientToken = $gateway->clientToken()->generate();
        // dd($clientToken);


        return response()->json(['clientToken' => $clientToken]);
    }
}
