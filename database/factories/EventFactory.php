<?php

use Faker\Generator as Faker;

$factory->define(App\Event::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            return factory('App\User')->create()->id;
        },
        'type' => $faker->randomElement(['sport' ,'culture', 'other']),
        'name' => $faker->word ,
        'description' =>  $faker->text,
        'due_date' => $faker->dateTimeBetween('+0 days', '+2 years'),
        'contact' => $faker->phoneNumber,
        'venue' => $faker->city,
        'thumbnail_path' => $faker->imageUrl,
    ];
});
