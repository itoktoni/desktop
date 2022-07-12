<?php

use App\Dao\Models\Building;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class BuildingTableSeeder extends Seeder
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
            Building::create([
               'building_name' => $faker->company,
               'building_description' => $faker->text($maxNbChars = 200),
               'building_contact_person' => $faker->name,
               'building_contact_phone' => $faker->phoneNumber,
               'building_address' => $faker->address,
            ]);
        }
    }
}