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
        for($i = 0; $i < 20; $i++){
            $type = new Type;
            $type->name = $faker->catchphrase();
            $type->logo = $faker->imageUrl(360, 360, 'foods', true);
            $type->color = $faker->hexColor();
            $type->save();
        }
    }
}
