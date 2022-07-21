<?php

use App\Dao\Models\WorkType;
use Illuminate\Database\Seeder;

class WorkTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(WorkType::class, 5)->create();
    }
}
