<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\{BlogTaggable, BlogPost, BlogCategory};
use Faker\Generator as Faker;

$factory->define(BlogTaggable::class, function (Faker $faker) {
    $randId = random_int(1,10);
    $randTypeOfModel = $faker->randomElement([BlogPost::class, BlogCategory::class]);

    $data = [
        'tag_id' => $randId,
        'taggable_id' => $randId,
        'taggable_type' => $randTypeOfModel,
    ];

    return $data;
});
