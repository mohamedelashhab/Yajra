<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'name'  => $faker->name,
        'image' => $faker->image(storage_path('images'),400,300),
        'screen_name' => $faker->word,
        'content' => $faker->paragraph,
        'description' => $faker->paragraph,
        'user_name' => $faker->name,
        'statuse' => $faker->randomElement(['statuse1', 'statuse2', 'statuse3']),
    ];
});