<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Restaurant;
use Faker\Generator as Faker;

$factory->define(Restaurant::class, function (Faker $faker) {
    return [
        //
        'restaurant_name'=>$faker->name,
        'description'=>$faker->text(60),
        'address'=>$faker->address,
        'vendor_id'=> function () {
            return factory(App\Vendor::class)->create()->id;
        }
    ];
});
