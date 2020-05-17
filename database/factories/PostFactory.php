<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Post;
use App\Models\User;
use Faker\Generator as Faker;


$autoIncrement = autoIncrementPost();
$factory->define(Post::class, function (Faker $faker) use ($autoIncrement) {
    $autoIncrement->next();
    return [
        'post_code' => $autoIncrement->current(),
        'title' => $faker->realText(20),
        'content' => $faker->realText(),
        'description' => $faker->realText(),
        'status' => array_rand(Post::$statuses),
        'user_id' => $faker->randomElement(User::pluck('id')),
    ];
});

function autoIncrementPost()
{
    for ($i = 'BD00000'; $i < 1000; $i++) {
        yield $i;
    }
}
