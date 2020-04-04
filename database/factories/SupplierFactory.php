<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Supplier;
use Faker\Generator as Faker;

$autoIncrement = autoIncrementSupplier();
$factory->define(Supplier::class, function (Faker $faker) use ($autoIncrement) {
    $autoIncrement->next();
    return [
        'supplier_code' => $autoIncrement->current(),
        'name' => $faker->unique()->name,
        'email' => $faker->unique()->email,
        'address' => $faker->address,
        'phone' => $faker->numerify('0#########'),
        'status' => array_rand(Supplier::$statuses),
        'company' => $faker->company,
        'tax_code' => $faker->numerify('##########'),
        'note' => $faker->realText(),
    ];
});

function autoIncrementSupplier()
{
    for ($i = 'NCC00000'; $i < 1000; $i++) {
        yield $i;
    }
}
