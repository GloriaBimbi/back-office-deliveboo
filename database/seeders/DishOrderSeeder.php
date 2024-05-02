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
        //$dish_order = new 
        $dish_order->quantity = 0;
        $dish_order->total_price = 0;
        foreach ($orders as $order) {
            $order->dishes()->sync($faker->randomElements($dishes, rand(1, 3)));
            foreach ($dishes as $dish) {
                if (in_array($dish->id, $order->dishes)) {
                    $dish_order->quantity++;
                }
            }

        }
        $dish_order->quantity->save();
    }
}
