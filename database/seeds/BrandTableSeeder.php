<?php

use App\Dao\Models\Brand;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        Brand::create([
            'brand_name' => $faker->word,
            'brand_description' => $faker->text($maxNbChars = 200),
        ]);

    }
}
