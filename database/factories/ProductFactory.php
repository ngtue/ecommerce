<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'slug' => '/img/macbook-pro.png',
        'price' => '24999.99',
        'description' => 'Macbook Pro'
    ];
});
