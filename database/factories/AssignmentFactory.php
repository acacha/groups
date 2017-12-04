<?php

use Acacha\Forge\Models\Assignment;
use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(Assignment::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->name
    ];
});
