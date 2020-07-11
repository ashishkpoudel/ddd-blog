<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Symfony\Component\Uid\Uuid;
use Weblog\Posts\Infrastructure\Eloquent\Models\TagModel;

$factory->define(TagModel::class, function (Faker $faker) {
    return [
        'id' => (string) Uuid::v4(),
        'name' => $faker->title,
    ];
});
