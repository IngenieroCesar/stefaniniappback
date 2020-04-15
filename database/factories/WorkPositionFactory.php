<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\WorkPosition;
use Faker\Generator as Faker;

$factory->define(WorkPosition::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence
    ];
});
