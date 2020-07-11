<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Symfony\Component\Uid\Uuid;
use Weblog\Users\Infrastructure\Eloquent\Models\UserModel;
use Weblog\Posts\Infrastructure\Eloquent\Models\PostModel;

$factory->define(PostModel::class, function (Faker $faker) {
    return [
        'id' => (string) Uuid::v4(),
        'title' => $faker->title,
        'slug' => Str::slug($faker->title),
        'body' => $faker->sentence(6),
        'userId' => function() {
            return factory(UserModel::class)->create()->id;
        },
        'publishedAt' =>Carbon::today()->toString(),
    ];
});
