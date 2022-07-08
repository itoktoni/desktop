<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Dao\Models\Product;
use Illuminate\Support\Str;
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

$factory->define(Product::class, function (Faker $faker) {
    return [
        'product_name' => $faker->name,
        'product_code' => $faker->randomDigit(),
        'product_image' => $faker->image(),
        'product_category_id' => 1,
        'product_brand_id' => 1,
        'product_unit_id' => 1,
        'product_description' => $faker->word(3),
        'product_created_at' => date('Y-m-d H:i:s'),
        'product_active' => 1,
    ];
});
