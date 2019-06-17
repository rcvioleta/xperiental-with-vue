<?php

use Faker\Generator as Faker;
use App\StudentInformation;

$factory->define(StudentInformation::class, function (Faker $faker) {
    $rand_num_2 = rand(0, 1);
    $gender_arr = ['male', 'female'];
    $rand_num_7 = rand(0, 6);
    $relationship_arr = ['mother', 'father', 'aunt', 'uncle', 'brother', 'sister', 'cousin'];
    $common_address = $faker->address;
    $emcon_full_name = $faker->firstName . ' ' . $faker->lastName;
    return [
        'id_num' => $faker->numberBetween(00000, 99999),
        'image' => 'images/avatar/avatar-default.png',
        'first_name' => $faker->firstName,
        'middle_name' => $faker->lastName,
        'last_name' => $faker->lastName,
        'gender' => $gender_arr[$rand_num_2],
        'birth_date' => $faker->dateTimeThisCentury->format('Y-m-d'),
        'phone_number' => $faker->tollFreePhoneNumber,
        'address' => $common_address,
        'emcon_full_name' => $emcon_full_name,
        'emcon_phone_number' => $faker->tollFreePhoneNumber,
        'emcon_relationship' => $relationship_arr[$rand_num_7],
        'emcon_address' => $common_address
    ];
});
