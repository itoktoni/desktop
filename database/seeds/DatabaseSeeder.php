<?php

use App\Dao\Models\Product;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // factory(Product::class, 10)->create();
        $faker  = Faker::create('id_ID');
        foreach(range(0,1000) as $integer){

            $this->call(UsersTableSeeder::class);
            $this->call(ProductTableSeeder::class);
        }
    }
}
