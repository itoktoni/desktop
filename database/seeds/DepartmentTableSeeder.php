<?php

use App\Dao\Models\Department;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

            $faker = Faker::create('id_ID');
            Department::create([
                'department_user_id' => $faker->numberBetween($min = 1, $max = 10),
                'department_name' => $faker->word,
                'department_description' => $faker->text($maxNbChars = 50),
            ]);
    }
}
