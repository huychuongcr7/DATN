<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\CategoryPost;
use App\Models\Post;
use App\Models\User;
use Faker\Generator as Faker;

$autoIncrement = autoIncrementPost();
$factory->define(Post::class, function (Faker $faker) use ($autoIncrement) {
    $autoIncrement->next();
    $paragraphs = rand(1, 5);
    $i = 0;
    $ret = "";
    while ($i < $paragraphs) {
        $ret .= "<p>" . $faker->paragraph(rand(2, 6)) . "</p>";
        $i++;
    }

    return [
        'post_code' => $autoIncrement->current(),
        'title' => $faker->name,
        'content' => $ret,
        'description' => $faker->realText(),
        'status' => array_rand(Post::$statuses),
        'user_id' => $faker->randomElement(User::pluck('id')),
        'category_id' => $faker->randomElement(CategoryPost::pluck('id')),
    ];
});

function autoIncrementPost()
{
    for ($i = 'BD00000'; $i < 1000; $i++) {
        yield $i;
    }
}
