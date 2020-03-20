<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\MenuItem;
use Faker\Generator as Faker;

$factory->define(\App\MenuItem::class, function (Faker $faker) {
    return [
        //
        'item_name'=>$faker->realText($maxNbChars = 20, $indexSize = 2),
        'item_description'=>$faker->text(110),
        'item_price'=>$faker->numberBetween(0,200),
        'notes'=>$faker->text(110),
        'menu_id'=>function () {
            return factory(App\Menu::class)->create()->id;
        }
    ];
});
