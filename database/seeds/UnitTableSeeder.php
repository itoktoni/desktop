<?php

use App\Dao\Models\Unit;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class UnitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        Unit::create([
            'unit_code' => $faker->unique()->numberBetween(1, 1000),
            'unit_name' => $faker->word,
        ]);
    }
}
