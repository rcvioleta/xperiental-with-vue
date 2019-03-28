<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Subject;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(User::class, 5)->create();
        factory(Subject::class, 30)->create();
    }
}
