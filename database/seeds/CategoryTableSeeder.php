<?php

use App\Dao\Models\Category;
use Faker\Factory as Faker;
use Faker\Provider\Fakecar;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
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
        Category::create([
            'category_name' => $faker->vehicleType,
            'category_description' => $faker->text($maxNbChars = 200),
            'category_active' => 1,
        ]);
    }
}
