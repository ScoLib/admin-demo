<?php

use Faker\Generator as Faker;

$factory->define(\App\Category::class, function (Faker $faker) {
    return [
        'parent_id' => 0,
        'name' => $faker->word,
        'slug' => $faker->slug(1),
    ];
});