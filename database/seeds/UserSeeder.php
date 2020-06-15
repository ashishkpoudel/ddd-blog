<?php

use Illuminate\Database\Seeder;
use src\Users\Infrastructure\Eloquent\Models\UserModel;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(UserModel::class)->create(['emailAddress' => 'admin@localhost', 'password' => bcrypt('123456')]);
    }
}
