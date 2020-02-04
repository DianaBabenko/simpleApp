<?php

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use App\Models\BlogPostMarker;

/** @var Factory $factory */

$factory->define(BlogPostMarker::class, static function (Faker $faker) {
    $title = $faker->sentence(random_int(1, 2), true);

    return [
        'title' => $title,
    ];
});
