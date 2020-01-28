<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\BlogPostMarker::class, function (Faker $faker) {
    $title = $faker->sentence(rand(1, 2), true);
    $createdAt = $faker->dateTimeBetween('-2 months', '-1 months');

    $data = [
        'title' => $title,
        'created_at' => $createdAt,
    ];

    return $data;
});
