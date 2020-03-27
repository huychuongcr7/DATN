<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Trademark;
use Faker\Generator as Faker;

$factory->define(Trademark::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->name
    ];
});
