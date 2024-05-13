<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     
     */
    public function index()
    {
        $restaurants = Restaurant::select(['id', 'user_id', 'name', 'description', 'address', 'image', 'slug'])
            ->with(['user:id,name,email', 'dishes:id,restaurant_id,name,image,description,price,ingredients_list,slug', 'types:id,name,logo,color'])
            ->paginate(12);

        foreach ($restaurants as $restaurant) {
            if (!str_starts_with($restaurant->image, 'https')) {

                $restaurant->image = !empty($restaurant->image)
                    ? $restaurant->getImage()
                    : null;
            }
        }

        return response()->json($restaurants);
    }
    /**
     * Display the specified resource applying advanced filters
     *
     * @param  int  $id
     
     */
    public function advancedFilters(Request $request)
    {
        $filters = $request->all();

        $restaurants = $restaurants = Restaurant::select(['id', 'user_id', 'name', 'description', 'address', 'image', 'slug']);
        if (Arr::exists($filters, 'types')) {
            foreach ($filters['types'] as $type_id) {
                $restaurants->whereHas('types', function (Builder $query) use ($type_id) {
                    $query->where('types.id', $type_id);
                });
            }
        }
        $restaurants = $restaurants->with((['user:id,name,email', 'dishes:id,restaurant_id,name,image,description,price,ingredients_list,slug', 'types:id,name,logo,color']))->get();
        
        foreach ($restaurants as $restaurant) {
            if (!str_starts_with($restaurant->image, 'https')) {
                $restaurant->image = !empty($restaurant->image)
                    ? asset('/storage/' . $restaurant->image)
                    : null;
            }
        }
        return response()->json([
            'result' => $restaurants,
            'success' => true,
        ]);
    }





    /**
     * Display the specified resource.
     *
     * @param  int  $id
     
     */
    public function show($slug)
    {
        $restaurant = Restaurant::select(['id', 'user_id', 'name', 'description', 'address', 'image', 'slug'])
            ->with(['user:id,name,email', 'dishes:id,restaurant_id,name,image,description,price,ingredients_list,slug', 'types:id,name,logo,color'])
            ->where('slug', $slug)
            ->first();
        // ->paginate(10);
        foreach ($restaurant->dishes as $dish) {
            if (!str_starts_with($dish->image, 'https')) {

                $dish->image = !empty($dish->image)
                    ? $dish->getImage()
                    : null;
            }
        }
        if (!str_starts_with($restaurant->image, 'https')) {

            $restaurant->image = !empty($restaurant->image)
                ? $restaurant->getImage()
                : null;
        }

        if (!$restaurant) {
            return response()->json([
                'message' => 'Restaurant not found'
            ], 404);
        }
        return response()->json($restaurant);
    }
}
