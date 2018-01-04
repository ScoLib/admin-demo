<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\Storage;

$factory->define(\App\Picture::class, function (Faker $faker) {
    /*$path = Storage::disk('public')->path(config('admin.upload.directory') . '/demo');
    if (! is_dir($path)) {
        mkdir($path, 0777, true);
    }*/

    return [
        'name' => $faker->word,
        //'path' => $faker->image($path)
        'path' => $faker->imageUrl(),
    ];
});
