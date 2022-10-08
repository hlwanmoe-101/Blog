<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'title' => $faker->word(10),
        'description' => $faker->paragraph(200),
        'category_id' => \App\Category::all()->random()->id,
        'user_id' => \App\User::all()->random()->id,
    ];
});
