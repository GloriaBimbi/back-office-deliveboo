<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Braintree\Gateway;
use App\Models\Order;
use App\Mail\PaymentSuccess;
use Illuminate\Support\Facades\Mail;

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
        return response()->json(['clientToken' => $clientToken]);
    }

    public function processPayment(Request $request)
    {
        $nonceFromTheClient = $request->input('paymentMethodNonce');
        $totalPrice = ltrim($request->input('amount'), '$');
// $validated=$request->all();
        $validated = $request->validate([
            'formData.name' => 'required|string|max:255',
            'formData.lastname' => 'required|string|max:255',

            'formData.addressStreet' => 'required|string|max:255',
            'formData.addressCivic' => 'required|string|max:10',
            'formData.addressCap' => 'required|string|max:5|min:5',
            'formData.addressCity' => 'required|string|max:100',
            'formData.addressCountry' => 'required|string|max:100',

            'formData.email' => 'required|email|max:255',
            'formData.phone' => 'required|string|max:10|min:9',
            'cart' => 'required|array',
            'cart.*.id' => 'required|integer',
            'cart.*.quantity' => 'required|integer',

        ]);

        var_dump($validated['formData']);

        $order = new Order;
        $order->name = $validated['formData']['name'];
        $order->lastname = $validated['formData']['lastname'];
        $order->address = $validated['formData']['addressStreet'] . ', ' . $validated['formData']['addressCivic'] . ', ' . $validated['formData']['addressCap'] . ' ' . $validated['formData']['addressCity'] . '(' . $validated['formData']['addressCountry'] . ')';
        $order->email = $validated['formData']['email'];
        $order->phone = $validated['formData']['phone'];
        $order->card_token = $nonceFromTheClient;
        $order->total_price = $totalPrice;
        $order->save();

        foreach ($validated['cart'] as $item) {

             if ($item && isset($item['id']) && isset($item['quantity'])) {
            $order->dishes()->attach($item['id'], ['quantity' => $item['quantity']]);
        } else {
            // Gestisci il caso in cui $item potrebbe essere null o non contenere id o quantity
            // Ad esempio, puoi registrare un avviso o ignorare l'elemento problematico
        }
        }

        $gateway = new Gateway([
            'environment' => env('BRAINTREE_ENV'),
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY'),
        ]);

        $result = $gateway->transaction()->sale([
            'amount' => $totalPrice,
            'paymentMethodNonce' => $nonceFromTheClient,
        ]);

        if ($result->success) {
            try {
                // Invio dell'email di conferma
                Mail::to($order->email)->send(new PaymentSuccess($order));
        
                // Restituzione di una risposta di successo
                return response()->json(['message' => 'Payment completed successfully']);
            } catch (\Exception $e) {
                // Registrazione dell'errore
                \Log::error('Error sending payment success email: ' . $e->getMessage());
        
                // Restituzione di una risposta di errore
                return response()->json(['error' => 'An error occurred while sending payment confirmation email'], 500);
            }
        } else {
            $error = $result->message;
            return response()->json(['error' => $error], 422);
        }
    }
}


