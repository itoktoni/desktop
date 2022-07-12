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
        foreach (range(0, 9) as $integer) {
            $this->call(UsersTableSeeder::class);
            $this->call(ProductTableSeeder::class);
            $this->call(BuildingTableSeeder::class);
            $this->call(LocationTableSeeder::class);
            $this->call(TagTableSeeder::class);
            $this->call(SparepartTableSeeder::class);
        }

        DB::table('routes')->delete();

        DB::table('routes')->insert(array (
            0 =>
            array (
                'route_code' => 'building',
                'route_name' => 'Building',
                'route_group' => 'master',
                'route_controller' => 'App\\Http\\Controllers\\Master\\BuildingController',
                'route_active' => 1,
                'route_description' => NULL,
                'route_sort' => 1,
            ),
            1 =>
            array (
                'route_code' => 'category',
                'route_name' => 'Category',
                'route_group' => 'master',
                'route_controller' => 'App\\Http\\Controllers\\Master\\CategoryController',
                'route_active' => 1,
                'route_description' => NULL,
                'route_sort' => 0,
            ),
            2 =>
            array (
                'route_code' => 'filters',
                'route_name' => 'Filters',
                'route_group' => 'system',
                'route_controller' => 'App\\Http\\Controllers\\System\\FiltersController',
                'route_active' => 1,
                'route_description' => NULL,
                'route_sort' => 0,
            ),
            3 =>
            array (
                'route_code' => 'groups',
                'route_name' => 'Groups',
                'route_group' => 'system',
                'route_controller' => 'App\\Http\\Controllers\\System\\GroupsController',
                'route_active' => 1,
                'route_description' => NULL,
                'route_sort' => 0,
            ),
            4 =>
            array (
                'route_code' => 'location',
                'route_name' => 'Location',
                'route_group' => 'master',
                'route_controller' => 'App\\Http\\Controllers\\Master\\LocationController',
                'route_active' => 1,
                'route_description' => NULL,
                'route_sort' => 0,
            ),
            5 =>
            array (
                'route_code' => 'product',
                'route_name' => 'Product',
                'route_group' => 'app',
                'route_controller' => 'App\\Http\\Controllers\\Master\\ProductController',
                'route_active' => 1,
                'route_description' => NULL,
                'route_sort' => 0,
            ),
            6 =>
            array (
                'route_code' => 'roles',
                'route_name' => 'Roles',
                'route_group' => 'system',
                'route_controller' => 'App\\Http\\Controllers\\System\\RolesController',
                'route_active' => 1,
                'route_description' => NULL,
                'route_sort' => 0,
            ),
            7 =>
            array (
                'route_code' => 'routes',
                'route_name' => 'Routes',
                'route_group' => 'system',
                'route_controller' => 'App\\Http\\Controllers\\System\\RoutesController',
                'route_active' => 1,
                'route_description' => NULL,
                'route_sort' => 0,
            ),
            8 =>
            array (
                'route_code' => 'sparepart',
                'route_name' => 'Sparepart',
                'route_group' => 'master',
                'route_controller' => 'App\\Http\\Controllers\\Master\\SparepartController',
                'route_active' => 1,
                'route_description' => NULL,
                'route_sort' => 0,
            ),
            9 =>
            array (
                'route_code' => 'tag',
                'route_name' => 'Tag',
                'route_group' => 'master',
                'route_controller' => 'App\\Http\\Controllers\\Master\\TagController',
                'route_active' => 1,
                'route_description' => NULL,
                'route_sort' => 0,
            ),
            10 =>
            array (
                'route_code' => 'user',
                'route_name' => 'User',
                'route_group' => 'master',
                'route_controller' => 'App\\Http\\Controllers\\Master\\UserController',
                'route_active' => 1,
                'route_description' => NULL,
                'route_sort' => 0,
            ),
        ));

        DB::table('groups')->delete();

        DB::table('groups')->insert(array (
            0 =>
            array (
                'group_code' => 'app',
                'group_name' => 'App',
                'group_icon' => 'package',
                'group_url' => NULL,
                'group_sort' => 2,
                'group_active' => 1,
            ),
            1 =>
            array (
                'group_code' => 'master',
                'group_name' => 'Master Data',
                'group_icon' => 'database',
                'group_url' => NULL,
                'group_sort' => 1,
                'group_active' => 1,
            ),
            2 =>
            array (
                'group_code' => 'system',
                'group_name' => 'System',
                'group_icon' => 'settings',
                'group_url' => NULL,
                'group_sort' => 3,
                'group_active' => 1,
            ),
        ));

    }
}
