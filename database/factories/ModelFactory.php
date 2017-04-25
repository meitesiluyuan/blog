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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Common\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'member_list_username' => $faker->name,
        'member_list_email' => $faker->unique()->safeEmail,
        'member_list_groupid'=>1,
        'member_list_pwd' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});
