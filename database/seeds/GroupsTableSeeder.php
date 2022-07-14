<?php

use App\Dao\Models\Groups;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public $model;

    public function __construct(Groups $model)
    {
        $this->model = $model;
    }

    public function run()
    {
        $this->model->delete();

        $this->model->insert(array(
            0 => array(
                'group_code' => 'app',
                'group_name' => 'App',
                'group_icon' => 'package',
                'group_url' => null,
                'group_sort' => 2,
                'group_active' => 1,
            ),
            1 => array(
                'group_code' => 'master',
                'group_name' => 'Master Data',
                'group_icon' => 'database',
                'group_url' => null,
                'group_sort' => 1,
                'group_active' => 1,
            ),
            2 => array(
                'group_code' => 'system',
                'group_name' => 'System',
                'group_icon' => 'settings',
                'group_url' => null,
                'group_sort' => 3,
                'group_active' => 1,
            ),
        ));

    }
}
