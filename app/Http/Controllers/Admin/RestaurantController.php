<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Type;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
// Generic request
use Illuminate\Http\Request;
// Store restaurant request
use Illuminate\Support\Facades\Storage;
// use App\Http\Requests\Auth\StoreRestaurantRequest;




class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
    //  * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = Restaurant::orderBy('id', 'DESC')->paginate(10);
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
        $user = Auth::user();
        $restaurant = new Restaurant();
        return view('admin.restaurant.create', compact('types', 'restaurant', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // Controllare metodo validated
        $request->validate([
            'description' => 'string|max:1000',
            'name' => 'required|string|max:75',

            'address_street' => 'required|string|max:255',
            'address_civic' => 'required|string|max:10',
            'address_postal_code' => 'required|string|max:5|min:5',
            'address_city' => 'required|string|max:100',
            'address_country' => 'required|string|max:100',

            'piva' => 'required|unique:restaurants|string|max:11|min:11',
            'image' => 'image|required',
            'types' => 'required|exists:types,id',
        ]);

        $data = $request->all();
        // dd($data);

        // Trasforma l'indirizzo in camel case
        $data['address_street'] = Restaurant::camelCase($data['address_street']);
        $data['address_city'] = Restaurant::camelCase($data['address_city']);
        $data['address_country'] = Restaurant::upperCase($data['address_country']);

        $restaurant = new Restaurant;
        $restaurant->fill($data);

        if (Arr::exists($data, 'image')) {
            $img_path = Storage::put('uploads\restaurant', $data['image']);
            $restaurant->image = $img_path;
        }
        // $img_path=Storage::disk('public')->put('uploads\restaurant', $data['image']);

        $restaurant->user_id = Auth::id();
        $restaurant->slug = Str::slug($restaurant->name);
        $restaurant->address = $data['address_street'] . ', ' . $data['address_civic'] . ', ' . $data['address_postal_code'] . ' ' . $data['address_city'] . ' (' . $data['address_country'] . ')';
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
