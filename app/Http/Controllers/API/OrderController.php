<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function processPayment(Request $request)
    {
        $formData = $request->all();

        dd($formData);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',

            'address_street' => 'required|string|max:255',
            'address_civic' => 'required|string|max:10',
            'address_postal_code' => 'required|string|max:5|min:5',
            'address_city' => 'required|string|max:100',
            'address_country' => 'required|string|max:100',

            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:10|min:9',

        ]);


        $order = new Order;
        $order->name = $formData['name'];
    }
}

// public function submit(Request $request)
//     {
//         // Validazione dei dati del form
//         $validated = $request->validate([
//             'name' => 'required|string|max:255',
//             'email' => 'required|email|max:255',
//             'message' => 'required|string'
//         ]);

//         // Creazione di un nuovo record nella tabella contacts
//         $contact = Contact::create([
//             'name' => $validated['name'],
//             'email' => $validated['email'],
//             'message' => $validated['message']
//         ]);

//         // Restituisce una risposta JSON di successo
//         return response()->json(['message' => 'Form data received successfully', 'contact' => $contact], 201);
//     }