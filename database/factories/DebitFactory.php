<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Debit::class, function (Faker $faker) {
    return [
        "debitor" =>$faker->name,
        "phone"=>$faker->phoneNumber,
        "amount"=>$faker->randomDigit,
        "timeToPay"=>$faker->date('Y-m-d H:i:s')
    ];
});
/*
how to make seeds 
-----------------
1. define Factories php artisan make:factory factoryName
2.define seed seed either php artisan make:seed seedName;
3. php artisan db:seed --class=seedName
*/
