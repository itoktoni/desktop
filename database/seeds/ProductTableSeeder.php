<?php

use App\Dao\Models\Product;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker  = Faker::create('id_ID');
        Product::create([
            'product_name' => $faker->name,
            'product_code' => $faker->randomDigit(),
            'product_category_id' => 1,
            'product_brand_id' => 1,
            'product_unit_id' => 1,
            'product_description' => $faker->word(3),
            'product_created_at' => date('Y-m-d H:i:s'),
            'product_active' => 1,
        ]);
    }
}
