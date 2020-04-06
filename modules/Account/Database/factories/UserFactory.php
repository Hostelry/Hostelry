<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Hostelry\Account\Entities\User;

$factory->define(User::class, function (Faker $faker) {
    return [
        "username" => $faker->email,
        "password" => \Illuminate\Support\Facades\Hash::make('password'),
        'api_token' => \Illuminate\Support\Str::random(32),
    ];
});
