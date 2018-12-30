<?php

use Faker\Generator as Faker;
use App\Post;

$factory->define(Post::class, function (Faker $faker) {
    return [
        //
      'title' => $faker->sentence,
      'body' => $faker->paragraphs(rand(3, 10), true),
    ];
});
