<?php

use Illuminate\Database\Seeder;
use Weblog\Posts\Infrastructure\Eloquent\Models\{PostModel, TagModel};

class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PostModel::query()->each(function (PostModel $post) {
            $post->tags()->saveMany(
                TagModel::query()->get()
            );
        });
    }
}
