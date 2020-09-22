<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use Faker\Generator as Faker;

$factory->define(App\Credit::class, function (Faker $faker) {
    return  [
        "creditor"=>$faker->name,
        "phone"=>$faker->phoneNumber,
        "amount"=>$faker->randomDigit,
        "timeToPay"=>$faker->date('Y-m-d H:i:s')
    ];
});
