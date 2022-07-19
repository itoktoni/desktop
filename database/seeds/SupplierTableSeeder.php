<?php

use App\Dao\Models\Supplier;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class SupplierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        Supplier::create([
            'supplier_name' => $faker->name,
            'supplier_contact' => $faker->tollFreePhoneNumber,
            'supplier_address' => $faker->streetAddress,
            'supplier_email' => $faker->email,
            'supplier_phone' => $faker->phoneNumber,
        ]);
    }
}