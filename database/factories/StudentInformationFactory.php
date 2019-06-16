<?php

use Faker\Generator as Faker;
use App\StudentInformation;

$factory->define(StudentInformation::class, function (Faker $faker) {
    $randNum = rand(0, 1);
    $genderArr = ['male', 'female'];
    $gender = $genderArr[$randNum];
    return [
        'first_name' => $faker->firstName,
        'middle_name' => $faker->lastName,
        'last_name' => $faker->lastName,
        'gender' => $gender,
        'birth_date' => $faker->dateTimeThisCentury->format('Y-m-d'),
        'phone_number' => $faker->tollFreePhoneNumber,
        'address' => $faker->address
    ];
});
