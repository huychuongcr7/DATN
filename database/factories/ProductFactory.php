<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use App\Models\Product;
use App\Models\Trademark;
use Faker\Generator as Faker;

$autoIncrement = autoIncrementProduct();
$factory->define(Product::class, function (Faker $faker) use ($autoIncrement) {
    $autoIncrement->next();
    $sale_price = $faker->bothify('##000');
    return [
        'product_code' => $autoIncrement->current(),
        'name' => $faker->unique()->name,
        'category_id' => $faker->randomElement(Category::pluck('id')),
        'trademark_id' => $faker->randomElement(Trademark::pluck('id')),
        'sale_price' => $sale_price,
        'entry_price' => $sale_price - 1000,
        'inventory' => $faker->numberBetween($min = 0, $max = 100),
        'inventory_level_min' => $faker->numberBetween($min = 0, $max = 10),
        'inventory_level_max' => $faker->numberBetween($min = 10, $max = 100),
        'status' => array_rand(Product::$statuses),
        'description' => $faker->realText(),
        'note' => $faker->realText(),
    ];
});

function autoIncrementProduct()
{
    for ($i = 'SP00000'; $i < 1000; $i++) {
        yield $i;
    }
}
