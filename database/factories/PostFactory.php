<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'post'=>$faker->paragraph(1),
        'category'=>$faker->text(10),
        'customer_id'=> function(){
            return factory(App\Customer::class)->create()->id;
        }

    ];
});
