<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Models\BlogPostComment::class, function (Faker $faker) {
    $title = $faker->sentence(rand(3, 8), true);
    $createdAt = $faker->dateTimeBetween('-2 months', '-1 months');

    $data = [
        'title' => $title,
        'user_id' => rand(1,3),
        'created_at' => $createdAt,
    ];

    return $data;
});
