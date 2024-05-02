<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class RestaurantTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $restaurants = Restaurant::all();
        $types = Type::all()->pluck('id')->toArray();
        foreach ($restaurants as $restaurant) {
            $restaurant->types()->sync($faker->randomElements($types, rand(1, 3)));
        }
    }
}
