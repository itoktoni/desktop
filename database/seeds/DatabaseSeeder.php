<?php

use App\Dao\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    // https://github.com/fzaninotto/Faker#formatters
    public function run()
    {
        factory(User::class, 1)->create();
        $faker = Faker::create('id_ID');

        $this->call(GroupsTableSeeder::class);
        $this->call(RoutesTableSeeder::class);

        foreach (range(0, 9) as $integer) {
            $this->call(UsersTableSeeder::class);
            $this->call(ProductTableSeeder::class);
            $this->call(BuildingTableSeeder::class);
            $this->call(LocationTableSeeder::class);
            $this->call(TagTableSeeder::class);
            $this->call(SparepartTableSeeder::class);
            $this->call(CategoryTableSeeder::class);
            $this->call(BrandTableSeeder::class);
        }
    }
}
