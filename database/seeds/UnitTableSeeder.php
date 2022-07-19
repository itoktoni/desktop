<?php

use App\Dao\Models\Unit;
use Illuminate\Database\Seeder;

class UnitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public $model;

    public function __construct(Unit $model)
    {
        $this->model = $model;
    }

    public function run()
    {
        $this->model->delete();

        $this->model->insert(array(
            [
                'unit_code' => '1',
                'unit_name' => 'unit test 1',
            ],
            [
                'unit_code' => '2',
                'unit_name' => 'unit test 2',
            ],
            [
                'unit_code' => '3',
                'unit_name' => 'unit test 3',
            ],
        ));

    }
}
