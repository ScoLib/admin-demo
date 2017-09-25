<?php

use Faker\Generator as Faker;

$factory->define(\App\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'slug' => $faker->slug(1),
        'pid' => 0,
    ];
});