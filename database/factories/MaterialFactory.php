<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Material;
use App\MaterialMeasuring;
use Faker\Generator as Faker;

$factory->define(Material::class, function (Faker $faker) {
    return [
        'name'=> $faker->name ,
        'measuring_id' => function () {
            return factory(MaterialMeasuring::class)->create()->id;
        }
    ];
});
