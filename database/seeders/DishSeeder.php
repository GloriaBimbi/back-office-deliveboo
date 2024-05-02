<?php

namespace Database\Seeders;

use App\Models\Dish;
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
        $dish = new Dish;
        $dish->name = 'Pizza Margherita';
        $dish->image = 'https://www.google.com/imgres?q=pizza&imgurl=https%3A%2F%2Fimages.ctfassets.net%2Fnw5k25xfqsik%2F64VwvKFqxMWQORE10Tn8pY%2F200c0538099dc4d1cf62fd07ce59c2af%2F20220211142754-margherita-9920.jpg%3Fw%3D1024&imgrefurl=https%3A%2F%2Fit.ooni.com%2Fblogs%2Frecipes%2Fmargherita-pizza&docid=dBUWQMjeEXS6_M&tbnid=1CS_cBw0YUoXKM&vet=12ahUKEwiz-LLojO-FAxU6V0EAHXKRDWgQM3oECGYQAA..i&w=1024&h=780&hcb=2&ved=2ahUKEwiz-LLojO-FAxU6V0EAHXKRDWgQM3oECGYQAA';
        $dish->description = 'pizza classica, buonissima!!';
        $dish->price = 6.50;
        $dish->visible = true;
        $dish->slug = Str::slug($dish->name);
        $dish->ingredients_list = 'pomodoro, mozzarella, basilico, farina, lievito, olio evo';
        $dish->save();

        $dish = new Dish;
        $dish->name = 'Risotto ai Gamberi';
        $dish->image = 'https://www.google.com/imgres?q=risotto%20ai%20gamberi&imgurl=https%3A%2F%2Fblog.giallozafferano.it%2Fadryincucina%2Fwp-content%2Fuploads%2F2017%2F09%2Frisotto-ai-gamberoni.jpg&imgrefurl=https%3A%2F%2Fblog.giallozafferano.it%2Fadryincucina%2Frisotto-ai-gamberi%2F&docid=rAA2tkuTmb1JmM&tbnid=HkbSWRwyUPuB1M&vet=12ahUKEwiH1dfvje-FAxUG6gIHHR-SC4cQM3oECE4QAA..i&w=3834&h=2187&hcb=2&ved=2ahUKEwiH1dfvje-FAxUG6gIHHR-SC4cQM3oECE4QAA';
        $dish->description = 'risotto squisito, ve lo consiglio!!';
        $dish->price = 22.50;
        $dish->visible = true;
        $dish->slug = Str::slug($dish->name);
        $dish->ingredients_list = 'riso erbolario, prezzemolo, gambero, olio evo, burro';
        $dish->save();

        for($i = 0; $i < 20; $i++){
            $dish = new Dish;
            $dish->name = $faker->catchPhrase();
            $dish->image = $faker->imageUrl(null, 360, 360, 'foods', true);
            $dish->description = $faker->paragraph();
            $dish->price = $faker->randomFloat(2, 0, 100);
            $dish->visible = true;
            $dish->slug = Str::slug($dish->name);
            $dish->ingredients_list = $faker->words(7, true);
            $dish->save();
        }
    }
}
