<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'id' => $faker->uuid,
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$3vsblDfHwb15QOcvAgUw0uRQcpKTUE6R2mXE47WsvAUlQJnouQ3Qm', // secret
        'gender' => $faker->randomElement(['male' ,'female']),
        'remember_token' => str_random(10),
    ];
});
