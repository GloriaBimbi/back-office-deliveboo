<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     
     */
    public function index()
    {
        $restaurants = Restaurant::select(['id', 'user_id', 'name', 'address', 'image', 'slug'])->with(['user:id,name,email', 'dishes:id,name,image,description,price,ingredients_list,slug', 'types:id,name,logo,color'])->paginate(10);

        return response()->json($restaurants);

    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     
     */
    public function show($slug)
    { {
            $restaurant = Restaurant::with('type', 'user', 'dishes')->where('slug', $slug);
            if (!$restaurant) {
                return response()->json([
                    'message' => 'Restaurant not found'
                ], 404);
            }
            return response()->json($restaurant);
        }
    }

}