<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Vendor;
use Faker\Generator as Faker;

$factory->define(Vendor::class, function (Faker $faker) {
    return [
        //
        'trading_name'=>$faker->company,
        'email'=>$faker->email,
        'contact_person_name'=>$faker->name,
        'contact_person_name'=>$faker->name,
        'contact_number'=>$faker->phoneNumber
    ];
});
