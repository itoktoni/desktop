<?php

use App\Dao\Models\Location;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class LocationTableSeeder extends Seeder
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
            Location::create([
               'location_name'=>$faker->word,
               'location_description'=>$faker->text($maxNbChars = 200),
            ]);
        }
    }
}
