<?php

use Illuminate\Database\Seeder;
use Weblog\Posts\Infrastructure\Eloquent\Models\PostModel;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(PostModel::class, 5)->create();
    }
}
