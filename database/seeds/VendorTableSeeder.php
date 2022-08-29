<?php

use App\Dao\Models\Vendor;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class VendorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        (new Vendor())->delete();
        foreach (range(1, 5) as $item) {
            Vendor::create([
                'supplier_name' => $faker->company,
                'supplier_contact' => $faker->name,
                'supplier_address' => $faker->streetAddress,
                'supplier_email' => $faker->email,
                'supplier_phone' => $faker->phoneNumber,
            ]);
        }
    }
}
