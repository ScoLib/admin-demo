<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\Storage;


$factory->define(\App\Picture::class, function (Faker $faker) {
    $path = Storage::disk('public')->path(config('admin.upload.directory') . '/demo');
    if (! is_dir($path)) {
        mkdir($path, 0777, true);
    }

    $image = str_replace([
        Storage::disk('public')->path(''),
        '\\'
    ], [
        '',
        '/'
    ], $faker->image($path, 800, 800));

    return [
        'name' => $faker->word,
        'path' => $image
        //'path' => $faker->imageUrl(800, 800),
    ];
});
