<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Menu;
use Faker\Generator as Faker;


$factory->define(Menu::class, function (Faker $faker) {
    return [
        //
        'menu_name'=>$faker->text(50),
        'description'=>$faker->text(120),
        'restaurant_id'=> function () {
            return factory(App\Restaurant::class)->create()->id;
        }
    ];
});
