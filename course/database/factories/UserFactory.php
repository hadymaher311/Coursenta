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

$factory->define(App\Student::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'username' => $faker->unique()->username,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('123456'),
        'status' => 1,
        // 'remember_token' => str_random(10),
    ];
});

$factory->define(App\Professor::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'username' => $faker->unique()->username,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('123456'),
        'field' => str_random(10),
        'mobile_number' => $faker->numberBetween(100000000,999999999),
        'address' => $faker->city,
    ];
});

$factory->define(App\Courses::class, function (Faker $faker) {

    return [
        'name' => $faker->name,
        'cost' => $faker->numberBetween(1000,9999),
        'offer_cost' => $faker->numberBetween(100,999),
        'describtion' => $faker->paragraph,
        'sessions_number' => $faker->numberBetween(10,99),
        'professor_id' => $faker->numberBetween(1,180),
        'verified' => $faker->numberBetween(0,1),
    ];
});

$factory->define(App\Attends::class, function (Faker $faker) {

    return [
        'student_id' => $faker->numberBetween(2,205),
        'course_code' => $faker->numberBetween(1,400),
    ];
});
