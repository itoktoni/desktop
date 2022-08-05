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
        (new Department())->delete();
        foreach (range(1, 10) as $item) {
            Department::create([
                'department_id' => $item,
                'department_user_id' => $faker->numberBetween($min = 1, $max = 10),
                'department_name' => $faker->company,
                'department_description' => $faker->text($maxNbChars = 50),
            ]);
        }
    }
}
