<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\Models\Order;

use App\Models\Restaurant;
use App\Models\Type;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function index()
  {
    $restaurantId = auth()->user()->restaurant->id;
    $restaurant=Restaurant::where('user_id',auth()->user()->id)->first();
    if($restaurant){

      $orders = Order::whereHas('dishes', function ($query) use ($restaurantId) {
        $query->where('restaurant_id', $restaurantId);
    })->get();

      $dishes=Dish::where('restaurant_id',$restaurant->id)->get();
      $types=Type::where('restaurant_id',$restaurant->id);
      return view('admin.dashboard', compact('restaurant', 'dishes','types','orders'));
    } else{
      return view('admin.dashboard', compact('restaurant'));

    }
  }
}
