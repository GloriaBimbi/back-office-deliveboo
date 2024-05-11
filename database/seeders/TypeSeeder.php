<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
//faker
use Faker\Generator as Faker;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $types = config('types');
        foreach ($types as $current_type) {
            $type = new Type;
            $type->name = $current_type['name'];
            $type->logo = $current_type['logo'];
            $type->color = $faker->hexColor();
            $type->save();
        }


        // for($i = 0; $i < 20; $i++){
        //     $type = new Type;
        //     $type->name = 'Restaurant from ' . $faker->state();
        //     $type->logo = $faker->imageUrl(360, 360, 'foods', true);
        //     $type->color = $faker->hexColor();
        //     $type->save();
        // }
    }
}
