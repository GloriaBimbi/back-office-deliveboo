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
        // $users_id=User::all()->pluck('id');

        $restaurants = config('restaurants');
        foreach($restaurants as $current_restaurant){
            $restaurant = new Restaurant;
            $restaurant->user_id = $current_restaurant['user_id'];
            $restaurant->name = $current_restaurant['name'];
            $restaurant->address = $current_restaurant['address'];
            $restaurant->piva = $current_restaurant['piva'];
            $restaurant->image = $current_restaurant['image'];
            $restaurant->description = $current_restaurant['description'];
            $restaurant->slug = Str::slug($restaurant->name);
            $restaurant->save();
        }



        // foreach($users_id as $user_id){
        //     $restaurant = new Restaurant;
        //     $restaurant->user_id = $user_id;
        //     $restaurant->description = $faker->paragraph();
        //     $restaurant->name = $faker->catchPhrase();
        //     $restaurant->address =  $faker->address();
        //     $restaurant->piva = $faker->randomNumber(5,true).$faker->randomNumber(6,true);
        //     $restaurant->image = $faker->imageUrl(null, 360, 360, 'restaurant', true);
        //     $restaurant->slug = Str::slug($restaurant->name);
        //     $restaurant->save();
        // }



        // $restaurant = new Restaurant;
        // // $restaurant->users_id = $faker->randomElement($users_id);
        // $restaurant->name = 'Red Shrimp';
        // // $restaurant->user()->name = 'Christian Slaiter';
        // // $restaurant->types()->name = 'Restaurant from Mississippi';
        // $restaurant->address = 'Ambrose St, 214, 39361 Shuqualak (Mississippi)';
        // $restaurant->piva = '12345678924';
        // $restaurant->image = 'https://tse3.mm.bing.net/th/id/OIG3.XY.CWMcEbm5U5B8KBfT3?pid=ImgGn';
        // $restaurant->description = 'Unique culinary experience featuring our freshest red prawns: a journey of marine flavors in a cozy and refined setting, where quality is our top priority.';
        // $restaurant->slug = Str::slug($restaurant->name);
        // $restaurant->save();


        // $restaurant = new Restaurant;
        // // $restaurant->user_id = $faker->randomElement($users_id);
        // $restaurant->name = 'Da GiGi';
        // // $restaurant->user->name = 'Gigi Diletto';
        // // $restaurant->types->name = 'Restaurant from California';
        // $restaurant->address = 'Avenida La Promesa, 10, 92679 Trabuco Canyon (California)';
        // $restaurant->piva = '14523687952';
        // $restaurant->image = 'https://tse4.mm.bing.net/th/id/OIG4.XCJJkPRPeoFNTmmvF.4H?pid=ImgGn';
        // $restaurant->description = 'Indulge in a culinary celebration of beef at our restaurant. From succulent steaks to gourmet burgers, each dish is crafted to perfection, showcasing the finest cuts and flavors for a truly unforgettable dining experience';
        // $restaurant->slug = Str::slug($restaurant->name);
        // $restaurant->save();

        // $restaurant = new Restaurant;
        // // $restaurant->user_id = $faker->randomElement($users_id);
        // $restaurant->name = 'TEXXN';
        // // $restaurant->user->name = 'Julia Michael';
        // // $restaurant->types->name = 'Restaurant from Texas';
        // $restaurant->address = 'Sarum Ct, 4679, 75052 Grand Prairie (Texas)';
        // $restaurant->piva = '14523687934';
        // $restaurant->image = 'https://tse3.mm.bing.net/th/id/OIG1.WbNZde_2WmQUATDfDapq?pid=ImgGn';
        // $restaurant->description = 'Savor the bold flavors of Texas with our authentic Texan fast food. From mouthwatering barbecue to hearty burgers and crispy fried chicken, experience a taste of the Lone Star State in every bite!';
        // $restaurant->slug = Str::slug($restaurant->name);
        // $restaurant->save();

        // $restaurant = new Restaurant;
        // // $restaurant->user_id = $faker->randomElement($users_id);
        // $restaurant->name = 'Mamma Sushi';
        // // $restaurant->user->name = 'Gloria Stewart';
        // // $restaurant->types->name = 'Restaurant from Hawaii';
        // $restaurant->address = 'Kanealii Ave, 2404, 96813 Honolulu (Hawaii)';
        // $restaurant->piva = '14523687945';
        // $restaurant->image = 'https://tse2.mm.bing.net/th/id/OIG4.QMc_ZuZ.dvyLsj1Gcg0s?pid=ImgGn';
        // $restaurant->description = 'Transport your taste buds to paradise at our Hawaiian sushi restaurant. Dive into a world of fresh seafood, vibrant flavors, and creative sushi rolls inspired by the islands. Experience a taste of Hawaii with every bite!';
        // $restaurant->slug = Str::slug($restaurant->name);
        // $restaurant->save();


    }
}
