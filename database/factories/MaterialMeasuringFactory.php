<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\MaterialMeasuring;
use Faker\Generator as Faker;

$factory->define(MaterialMeasuring::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
