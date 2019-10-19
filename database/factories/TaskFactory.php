<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    $im = $faker->image(public_path('uploads/images/'),100,50);
    $str_arr =  explode ("/", $im);
    $img = str_replace(['\\'], '', $str_arr[2]);
    // echo($img);
    return [
        'name'  => $faker->name,
        'image' => $img,
        'screen_name' => $faker->word,
        'content' => $faker->paragraph,
        'description' => $faker->paragraph,
        'user_name' => $faker->name,
        'statuse' => $faker->randomElement(['statuse1', 'statuse2', 'statuse3']),
    ];
});