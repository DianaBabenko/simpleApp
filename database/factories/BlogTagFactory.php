<?php

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use App\Models\{BlogPost, BlogCategory, BlogTag};

/** @var Factory $factory */

$factory->define(BlogTag::class, static function (Faker $faker) {
    $title = $faker->sentence(random_int(1,3), true);
    $randId = random_int(1,10);
    $randTypeOfModel = $faker->randomElement([BlogPost::class, BlogCategory::class]);

    return [
        'title' => $title,
        'taggable_id' => $randId,
        'taggable_type' => $randTypeOfModel,
    ];
});
