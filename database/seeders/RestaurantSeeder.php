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
        $users_id = User::all()->pluck('id');

        $file = fopen(__DIR__ . '/../csv/restaurant.csv', 'r');
        $first_line = true;

        while (!feof($file)) {
            $restaurant_data = fgetcsv($file);

            if (!$first_line) {
                $restaurant = new Restaurant;
                $restaurant->user_id = $restaurant_data[0];
                $restaurant->name = $restaurant_data[1];
                $restaurant->address = $restaurant_data[2];
                $restaurant->piva = $restaurant_data[3];
                $restaurant->image = $restaurant_data[4];
                $restaurant->description = $restaurant_data[5];
                $restaurant->slug = Str::slug($restaurant->name);
                $restaurant->save();
            }
            $first_line = false;
        }
    }
}
