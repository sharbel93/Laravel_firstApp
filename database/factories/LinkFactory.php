<?php

use Faker\Generator as Faker;

// We use the $faker->sentence() method to generate a title,
//  and substr to remove the period at the end of the sentence.

$factory->define(App\Link::class, function (Faker $faker) {
    return [
        'title' => substr($faker -> sentence(2), 0, -1),
        'url' => $faker -> url,
        'description' => $faker -> paragraph,
    ];
});
