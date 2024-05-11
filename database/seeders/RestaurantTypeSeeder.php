<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $file = fopen(__DIR__ . '/../csv/restaurantType.csv', 'r');
        $first_line = true;
        while (!feof($file)) {
            $restaurant_type_data = fgetcsv($file);

            if (!$first_line) {
                $restaurant = Restaurant::find($restaurant_type_data[0]);
                $restaurant->types()->attach($restaurant_type_data[1]);
            }
            $first_line = false;
        }
    }
}
