<?php

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use App\Models\BlogPost;

/** @var Factory $factory */

$factory->define(BlogPost::class, static function (Faker $faker) {
    $title = $faker->sentence(random_int(3, 8), true);
    $txt = $faker->realText(random_int(1000, 4000));
    $isPublished = random_int(1, 5) > 1;

    $createdAt = $faker->dateTimeBetween('-3 months', '-2 months');

    $post = [
        'category_id' => random_int(1, 11),
        'user_id' => (random_int(1, 5) === 5) ? 1 : 2,
        'title' => $title,
        'slug' => Str::slug($title),
        'excerpt' => $faker->text(random_int(40, 100)),
        'content_raw' => $txt,
        'content_html' => $txt,
        'is_published' => $isPublished,
        'published_at' => $isPublished ? $faker->dateTimeBetween('-2 months', '-1 days') : null,
        'created_at' => $createdAt,
        'updated_at' => $createdAt,
    ];

    return $post;
});
