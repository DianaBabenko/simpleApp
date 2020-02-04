<?php

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use App\Models\{BlogTaggable, BlogPost, BlogCategory};

/** @var Factory $factory */

$factory->define(BlogTaggable::class, static function (Faker $faker) {
    $randId = random_int(1,10);
    $randTypeOfModel = $faker->randomElement([BlogPost::class, BlogCategory::class]);

    return [
        'tag_id' => $randId,
        'taggable_id' => $randId,
        'taggable_type' => $randTypeOfModel,
    ];
});
