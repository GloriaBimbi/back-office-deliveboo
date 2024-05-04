<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Type;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;


class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
    //  * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = Restaurant::orderBy('id','DESC')->paginate(10);
        // $types= Type::all();
        return view('admin.restaurant.index', compact('restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     *
    //  * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        return view('admin.restaurant.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $restaurant = new Restaurant;
        $restaurant->fill($data);
        $restaurant->user_id=Auth::id();
        $restaurant->slug=Str::slug($restaurant->name);
        $restaurant->address=$data['address_street'].', '.$data['address_civic'].', '.$data['address_postal_code'].' '.$data['address_city'].' ('.$data['address_country'].')';
        $restaurant->save();
        
        $restaurant->types()->attach($data['types']);
        // if(Arr::exists($data, 'types')){

        return redirect()->route('admin.restaurants.show', compact('restaurant'));
    }

    /**
     * Display the specified resource.
     *
    //  * @param  \App\Models\Restaurant  $restaurant
    //  * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        return view('admin.restaurant.show', compact('restaurant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        $restaurant->types()->detach();
        $restaurant->dishes()->delete();
        $restaurant->delete();  // delete
        return redirect()->route('admin.restaurants.index');
    }
}
