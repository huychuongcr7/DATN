<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\User;
//use Faker\Factory;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->name,
        'email' => $faker->unique()->email,
        'password' => bcrypt('123456'),
        'status' => array_rand(User::$statuses),
        'gender' => array_rand(User::$genders),
        'role' => array_rand(User::$roles),
    ];
});
