<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function ($faker) {
    return [
        'email' => $faker->email,
        'password' => $faker->password
    ];
});

$factory->define(App\Models\Job::class, function ($faker) {
    return [
      'job_title' => $faker->title,
      'job_description' => $faker->paragraph,
      'location' => $faker->state
    ];
});
