<?php

use App\Dao\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {   
        foreach(range(0,1000) as $integer){

            $this->call(UsersTableSeeder::class);
            // factory(User::class, 100)->create();
        }
    }
}
