<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
//faker
use Faker\Generator as Faker;

// facade for hashing
use Illuminate\Support\Facades\Hash;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 10; $i++) {
            $order = new Order;
            $order->name = $faker->firstName();
            $order->lastname = $faker->lastName();
            $order->address = $faker->streetAddress();
            $order->phone = $faker->phoneNumber();
            $order->email = $faker->email();
            $order->card_owner_name = $faker->firstName();
            $order->card_owner_lastname = $faker->lastName();
            $order->card = Hash::make($faker->creditCardNumber());
            $order->cvv = Hash::make($faker->randomNumber(3, true));
            $order->expiration = $faker->creditCardExpirationDateString();
            // $order->quantity = $faker->randomNumber(1, 20);
            $order->total_price = $order->dishes->sum('price');
            $order->save();
        }
    }
}
