<?php

use App\Dao\Models\Product;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        Product::create([
            'product_name' => $faker->name,
            'product_code' => $faker->randomDigit(),
            'product_category_id' => $faker->numberBetween($min = 1, $max = 10),
            'product_brand_id' => $faker->numberBetween($min = 1, $max = 10),
            'product_unit_id' => $faker->numberBetween($min = 1, $max =3),
            'product_description' => $faker->text($maxNbChars = 100),
            'product_created_at' => date('Y-m-d H:i:s'),
            'product_active' => 1,
        ]);
    }
}
