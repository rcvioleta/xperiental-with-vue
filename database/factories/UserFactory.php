<?php

use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
  $name = $faker->name;
  return [
    'name' => $name,
    'avatar' => '/images/avatar/avatar-default.png',
    'slug' => str_slug($name),
    'email' => $faker->unique()->safeEmail,
    'email_verified_at' => now(),
    'password' => 'password',
    'status' => 1,
    'remember_token' => Str::random(10),
  ];
});
