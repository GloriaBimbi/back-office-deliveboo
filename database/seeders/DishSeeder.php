<?php

namespace Database\Seeders;

use App\Models\Dish;
use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
//faker
use Faker\Generator as Faker;

//slug creation
use Illuminate\Support\Str;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $restaurants = Restaurant::all()->pluck('id');

        $file = fopen(__DIR__ . '/../csv/dishes.csv', 'r');
        $first_line = true;
        while (!feof($file)) {
            $dish_data = fgetcsv($file);

            if (!$first_line) {
                $dish = new Dish;
                $dish->restaurant_id = $dish_data[0];
                $dish->name = $dish_data[1];
                $dish->image = $dish_data[2];
                $dish->description = $dish_data[3];
                $dish->price = $dish_data[4];
                $dish->visible = true;
                $dish->ingredients_list = $dish_data[6];
                $dish->slug = Str::slug($dish->name);
                $dish->save();
            }
            $first_line = false;
        }
    }
}
