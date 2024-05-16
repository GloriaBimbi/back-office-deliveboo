<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Braintree\Gateway;
use App\Models\Order;


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

    public function processPayment(Request $request)
    {

        $nonceFromTheClient = $request->input('paymentMethodNonce');
        $totalPrice = ltrim($request->input('amount'), '$');

        $validated = $request->all();

        $formData = $validated['formData'];

        $order = new Order;
        $order->name = $formData['name'];
        $order->lastname = $formData['lastname'];
        $order->address = $formData['addressStreet'] . ', ' . $formData['addressCivic'] . ', ' . $formData['addressCap'] . '' . $formData['addressCity'] . '(' . $formData['addressCountry'] . ')';
        $order->email = $formData['email'];
        $order->phone = $formData['phone'];
        $order->card_token = $validated['paymentMethodNonce'];
        $order->total_price = $totalPrice;
        $order->save();

        foreach ($validated['cart'] as $item) {
            // var_dump($item);
            $order->dishes()->attach($item['id'], ['quantity' => $item['quantity']]); // Collega i piatti all'ordine
        }

        // var_dump($validated);

        // Elaborazione del pagamento con Braintree
        $gateway = new Gateway([
            'environment' => env('BRAINTREE_ENV'),
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY'),
        ]);
        $result = $gateway->transaction()->sale([
            'amount' => $totalPrice,
            'paymentMethodNonce' => $validated['paymentMethodNonce'],
            // Altri dettagli della transazione
        ]);

        // Gestione della risposta di Braintree
        if ($result->success) {
            // Transazione completata con successo
            // Registra i dettagli della transazione nel tuo sistema
            return response()->json(['message' => 'Payment completed successfully']);
        } else {
            // Errore durante il pagamento
            $error = $result->message;
            return response()->json(['error' => $error], 422);
        }
    }
}

        // $validated = $request->validate([
        //     'name' => 'required|string|max:255',
        //     'lastname' => 'required|string|max:255',

        //     'address_street' => 'required|string|max:255',
        //     'address_civic' => 'required|string|max:10',
        //     'address_postal_code' => 'required|string|max:5|min:5',
        //     'address_city' => 'required|string|max:100',
        //     'address_country' => 'required|string|max:100',

        //     'email' => 'required|email|max:255',
        //     'phone' => 'required|string|max:10|min:9',

        // ]);