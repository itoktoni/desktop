<?php

use App\Dao\Models\Brand;
use Faker\Factory as Faker;
use Faker\Provider\Fakecar;
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
        $faker->addProvider(new Fakecar($faker));
        Brand::create([
            'brand_name' => $faker->vehicleBrand,
            'brand_description' => $faker->text($maxNbChars = 200),
        ]);

    }
}
