<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Expense;
use Faker\Generator as Faker;

$factory->define(Expense::class, function (Faker $faker) {
    return [
        "category" => $faker-> sentence,
        "description" => $faker->word,
        "amount" => $faker->randomDigit 
    ];
});
