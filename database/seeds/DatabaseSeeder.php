<?php

use App\Dao\Models\User;
use Faker\Factory as Faker; // https://github.com/fzaninotto/Faker#formatters
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    public function run()
    {
        factory(User::class, 1)->create();
        $faker = Faker::create('id_ID');

        $this->call(GroupsTableSeeder::class);
        $this->call(RoutesTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UnitTableSeeder::class);
        $this->call(WorkTypeTableSeeder::class);
        $this->call(WorkSheetTableSeeder::class);
        $this->call(TicketTopicTableSeeder::class);

        $this->call(UsersTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(BuildingTableSeeder::class);
        $this->call(LocationTableSeeder::class);
        $this->call(TagTableSeeder::class);
        $this->call(SparepartTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(BrandTableSeeder::class);
        $this->call(SupplierTableSeeder::class);
        $this->call(MenusTableSeeder::class);
        $this->call(DepartmentTableSeeder::class);
    }
}
