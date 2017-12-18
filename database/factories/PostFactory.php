<?php

use Faker\Generator as Faker;

$factory->define(\App\Post::class, function (Faker $faker) {
    $category = \App\Category::first();
    return [
        'title' => $faker->sentence,
        'content' => $faker->text,
        'category_id' => $category->id,
    ];
});
