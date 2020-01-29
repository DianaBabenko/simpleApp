<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Models\{BlogPost, BlogCategory, BlogTag};

$factory->define(BlogTag::class, function (Faker $faker) {
    $title = $faker->sentence(random_int(1,3), true);
    $randId = random_int(1,10);
    $randTypeOfModel = $faker->randomElement([BlogPost::class, BlogCategory::class]);

    $data = [
        'title' => $title,
        'taggable_id' => $randId,
        'taggable_type' => $randTypeOfModel,
    ];

    return $data;
});
