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
        $restaurants = Restaurant::select(['id', 'user_id', 'name','description', 'address', 'image', 'slug'])
        ->with(['user:id,name,email', 'dishes:id,restaurant_id,name,image,description,price,ingredients_list,slug', 'types:id,name,logo,color'])
        ->paginate(10);

        foreach($restaurants as $restaurant){
            if(!str_starts_with($restaurant->image,'https')){

                $restaurant->image=!empty($restaurant->image)
                ?$restaurant->getImage()
                :null;
            } 
        }

        return response()->json($restaurants);

    }
}
// }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     
     */
    // public function show($slug)
    // { {
    //         $restaurant = Restaurant::with('type', 'user', 'dishes')->where('slug', $slug);
    //         if (!$restaurant) {
    //             return response()->json([
    //                 'message' => 'Restaurant not found'
    //             ], 404);
    //         }
    //         return response()->json($restaurant);
    //     }
    // }

// }