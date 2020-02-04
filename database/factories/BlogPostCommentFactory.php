<?php

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use App\Models\BlogPostComment;

/** @var Factory $factory */

$factory->define(BlogPostComment::class, static function (Faker $faker): array
{
    $title = $faker->sentence(random_int(3, 8), true);
    $createdAt = $faker->dateTimeBetween('-2 months', '-1 months');

    return [
        'title' => $title,
        'user_id' => random_int(1,3),
        'created_at' => $createdAt,
    ];
});
