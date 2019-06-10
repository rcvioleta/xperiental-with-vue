<?php

use Faker\Generator as Faker;
use App\Instructor;

$factory->define(Instructor::class, function (Faker $faker) {
    $randNum = rand(0, 1);
    $genderList = ['male', 'female'];
    $gender = $genderList[$randNum];
    return [
        'id_num' => $faker->numberBetween(1, 200),
        'image' => 'images/avatar/avatar-default.png',
        'first_name' => $faker->firstName,
        'middle_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'position' => 'instructor',
        'gender' => $gender,
        'bday' => '2019-05-23',
        'contact_num' => $faker->tollFreePhoneNumber,
        'address' => $faker->address,
        'hired_date' => '2010-05-12',
        'status' => 1
    ];
});
