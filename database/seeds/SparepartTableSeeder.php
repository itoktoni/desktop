<?php

use App\Dao\Models\Sparepart;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class SparepartTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 20) as $item) {

            $faker = Faker::create('id_ID');
            Sparepart::create([
                'sparepart_name' => $faker->word,
                'sparepart_location_id' => $faker->numberBetween($min = 1, $max = 10),
                'sparepart_description' => $faker->text($maxNbChars = 200),
                'sparepart_stock' => $faker->randomDigit,
            ]);
        }
    }
}
