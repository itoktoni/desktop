<?php

use App\Dao\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 10) as $item) {

            $faker = Faker::create('id_ID');
            User::create([
                'name' => $faker->name,
                'username' => $faker->userName(),
                'email' => $faker->email,
                'active' => 1,
                'role' => 2,
                'email_verified_at' => now(),
                'password' => bcrypt('secret'),
                'remember_token' => null,
            ]);
        }
    }
}
