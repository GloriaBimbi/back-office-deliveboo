<?php

namespace Database\Seeders;

use App\Models\Dish;
use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class DishOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $orders = Order::all();
        $dishes = Dish::all()->pluck('id')->toArray();
    }
}
