<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Weblog\Posts\Infrastructure\Eloquent\Models\TagModel;

$factory->define(TagModel::class, function (Faker $faker) {
    return [
        'id' => Str::uuid(),
        'name' => $faker->title,
    ];
});
