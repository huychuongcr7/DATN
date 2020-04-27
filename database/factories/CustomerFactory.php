<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Customer;
use Faker\Factory;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->name,
        'email' => $faker->unique()->email,
        'password' => bcrypt('123456'),
        'address' => $faker->address,
        'date_of_birth' => $faker->date(),
        'phone' => $faker->numerify('0#########'),
        'status' => array_rand(Customer::$statuses),
        'customer_type' => array_rand(Customer::$types),
        'gender' => array_rand(Customer::$genders),
    ];
});
