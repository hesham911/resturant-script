<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Supply;
use App\User;
use App\Material;

$factory->define(Supply::class, function (Faker $faker) {
    return [
        'material_id' => function () {
            return factory(Material::class)->create()->id;
        } , 
        'user_id'  => function () {
            return factory(User::class)->create()->id;
        },
        'quantity' => $faker->numberBetween(1, 82) ,
        'price' => $faker->numberBetween(20, 100) ,
        'expiry_date' => $faker->dateTimeBetween('+1 month', '+3 month') ,
        'Supplier_name' => 'mohamed' , 
        'bill_number' => $faker->numberBetween(1000000 , 2000000) , 
    ];
});
