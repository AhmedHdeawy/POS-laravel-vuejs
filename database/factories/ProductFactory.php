<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {

    return [
        'name'  =>  $faker->realText(30),
        'price'   =>  $faker->randomNumber(3),
        'quantity'   =>  $faker->randomNumber(2),
    ];
});
