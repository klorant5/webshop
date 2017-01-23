<?php

//
//$factory(\App\User::class, [
//    'name' => $faker->name,
//    'email' => $faker->email,
//    'password' => $faker->word,
//]);


$factory(\App\Product::class, [
    'name' => $faker->word,
    'description' => $faker->sentence,
    'price' => $faker->numberBetween(100, 500000),
    'quantity' => $faker->numberBetween(10,1000),
    'active' => 1,
]);
