<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Post;

$factory->define(Post::class, function (Faker $faker) {
    return [
        //
        'title' => $faker->sentence(3),
        'description' => $faker->text(50),
        'content' => $faker->text(500),
        'image' => $faker->sentence(2)

    ];
});
