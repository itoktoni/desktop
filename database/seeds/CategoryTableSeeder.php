<?php

use App\Dao\Models\Category;
use Faker\Factory as Faker;
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
        Category::create([
            'category_name' => $faker->word,
            'category_description' => $faker->text($maxNbChars = 200),
            'category_active' => 1,
        ]);
    }
}
