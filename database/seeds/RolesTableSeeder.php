<?php

use App\Dao\Models\Roles;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public $model;

    public function __construct(Roles $model)
    {
        $this->model = $model;
    }

    public function run()
    {
        $this->model->delete();

        $this->model->insert(array(
            [
                'role_code' => '1',
                'role_name' => 'admin',
                'role_description' => 'Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.',
                'role_active' => 1,
            ],
            [
                'role_code' => '2',
                'role_name' => 'user',
                'role_description' => 'Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.',
                'role_active' => 1,
            ],
        ));

    }
}
