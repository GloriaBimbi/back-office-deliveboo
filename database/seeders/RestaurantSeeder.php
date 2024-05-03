<?php

namespace Database\Seeders;

use App\Models\Dish;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;


//slug creation
use Illuminate\Support\Str;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $users_id=User::all()->pluck('id');


        foreach($users_id as $user_id){
            $restaurant = new Restaurant;
            $restaurant->user_id = $user_id;
            $restaurant->name = $faker->catchPhrase();
            $restaurant->address =  $faker->address();
            $restaurant->piva = $faker->randomNumber(5,true).$faker->randomNumber(6,true);
            $restaurant->image = $faker->imageUrl(null, 360, 360, 'restaurant', true);
            $restaurant->slug = Str::slug($restaurant->name);
            $restaurant->save();
        }



        // $restaurant = new Restaurant;
        // $restaurant->users_id = $faker->randomElement($users_id);
        // $restaurant->name = 'Gambero Rosso';
        // $restaurant->address = 'Via Marconi, 15';
        // $restaurant->piva = '12345678924';
        // $restaurant->image = 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.ristorantegamberorossoriccione.it%2F&psig=AOvVaw1gfjKLDC9mWQi4hJy_Ec_h&ust=1714742636743000&source=images&cd=vfe&opi=89978449&ved=0CBIQjRxqFwoTCPjs66GI74UDFQAAAAAdAAAAABAO';
        // $restaurant->slug = Str::slug($restaurant->name);
        // $restaurant->save();


        // $restaurant = new Restaurant;
        // $restaurant->user_id = $faker->randomElement($users_id);
        // $restaurant->name = 'Giallo Zafferano';
        // $restaurant->address = 'Via Roma, 3/B';
        // $restaurant->piva = '14523687952';
        // $restaurant->image = 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.tripadvisor.it%2FRestaurant_Review-g194878-d1535638-Reviews-Ristorante_Gambero_Rosso-Riccione_Province_of_Rimini_Emilia_Romagna.html&psig=AOvVaw1gfjKLDC9mWQi4hJy_Ec_h&ust=1714742636743000&source=images&cd=vfe&opi=89978449&ved=0CBIQjRxqFwoTCPjs66GI74UDFQAAAAAdAAAAABAW';
        // $restaurant->slug = Str::slug($restaurant->name);
        // $restaurant->save();
    }
}
