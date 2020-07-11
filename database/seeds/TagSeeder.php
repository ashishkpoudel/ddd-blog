<?php

use Illuminate\Database\Seeder;
use Weblog\Posts\Infrastructure\Eloquent\Models\TagModel;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(TagModel::class, 5)->create();
    }
}
