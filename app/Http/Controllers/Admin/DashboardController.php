<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\Models\Restaurant;
use App\Models\Type;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function index()
  {
    $restaurant=Restaurant::where('user_id',auth()->user()->id)->first();
    if($restaurant){

      $dishes=Dish::where('restaurant_id',$restaurant->id)->get();
      $types=Type::where('restaurant_id',$restaurant->id);
      return view('admin.dashboard', compact('restaurant', 'dishes','types'));
    } else{
      return view('admin.dashboard', compact('restaurant'));

    }
  }
}
