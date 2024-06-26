<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDishRequest;
use App\Http\Requests\UpdateDishRequest;
use Illuminate\Support\Str;
use App\Models\Dish;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $dishes = Dish::orderBy('id', 'DESC')->paginate(10);
        return view('admin.dishes.index', compact('dishes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $userId = Auth::user()->id;
        $userRestaurant = Restaurant::where('user_id', $userId)->exists();
        // dd($userRestaurantDish);

        if(!$userRestaurant){

            return redirect()->route('admin.dashboard')->withErrors(['user_id' => 'User has to create a restaurant first.']);
        }else{
            $dish = new Dish;
            return view('admin.dishes.form', compact('dish'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(StoreDishRequest $request, Restaurant $restaurant)
    {
        $request->validated();
        $data = $request->all();

        $dish = new Dish;
        $dish->fill($data);
        if (Arr::exists($data, "image")) {
            $img_path = Storage::put('uploads/dishes', $data["image"]);
            $dish->image = $img_path;
        }
        // dd($data);
        $current_user = Auth::id();
        $restaurant = Restaurant::where('user_id', $current_user)->first();
        $dish->slug = Dish::generateUniqueSlug($dish->name);
        $restaurant_id = $restaurant->id;
        $dish->restaurant_id = $restaurant_id;
        $dish->visible = true;
        // $dish->user_id = Auth::id();
        $dish->save();

        return redirect()->route('admin.dishes.show', compact('dish'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dish  $dish
     */
    public function show(Dish $dish)
    {
        return view('admin.dishes.show', compact('dish'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dish  $dish
     */
    public function edit(Dish $dish)
    {
        $userId = Auth::user()->id;
        $userRestaurantId = Restaurant::where('user_id', $userId)->first();

        // dd($userRestaurantId->id);

        if($dish->restaurant_id==$userRestaurantId->id){
            return view('admin.dishes.form', compact('dish'));
        }else{
            return redirect()->route('admin.dashboard')->withErrors(['user_id' => 'User cannot edit other restaurant dishes.']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDishRequest $request, Dish $dish)
    {
        $request->validated();
        $data = $request->all();
        $dish->update($data);

        if (Arr::exists($data, "image")) {
            if (!empty($dish->image)) {
                Storage::delete($dish->image);
            }
            $img_path = Storage::put('uploads/dishes', $data["image"]);
            $dish->image = $img_path;
        }

        $dish->save();
        return redirect()->route('admin.dishes.show', $dish);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dish $dish)
    {

        $dish->delete();  // delete

        return redirect()->route('admin.dashboard');
    }

    public function updateVisible(Dish $dish, Request $request)
    {
        // dd($request);
        $data = $request->all();
        $dish->visible = Arr::exists($data, 'visible') ? true : false;
        $dish->save();
        return redirect()->route('admin.dashboard');
    }
}
