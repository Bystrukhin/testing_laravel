<?php

use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Article::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
    ];
});

$factory->define(App\Team::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'size' => 5
    ];
});

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'user_id' => factory(App\User::class)->create()->id,
        'title' => $faker->sentence,
        'body' => $faker->paragraph,

    ];
});