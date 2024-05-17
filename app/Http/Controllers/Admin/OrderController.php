<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
    //  * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $restaurantId = auth()->user()->restaurant->id;
    
        $sortField = $request->get('sort', 'created_at'); // Campo di default per l'ordinamento
        $sortDirection = $request->get('direction', 'asc'); // Direzione di default
    
        $allowedSortFields = ['id', 'name', 'lastname', 'address', 'email', 'phone', 'created_at', 'total_price'];
    
        if (!in_array($sortField, $allowedSortFields)) {
            $sortField = 'created_at';
        }
    
        $orders = Order::whereHas('dishes', function ($query) use ($restaurantId) {
            $query->where('restaurant_id', $restaurantId);
        })->orderBy($sortField, $sortDirection)->paginate(10);
    
        return view('admin.orders', compact('orders', 'sortField', 'sortDirection'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
