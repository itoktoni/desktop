<?php

use App\Dao\Models\Routes;
use Illuminate\Database\Seeder;

class RoutesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public $model;

    public function __construct(Routes $model)
    {
        $this->model = $model;
    }

    public function run()
    {
        $this->model->delete();

        $this->model->insert(array(
            [
                'route_code' => 'building',
                'route_name' => 'Building',
                'route_group' => 'master',
                'route_controller' => 'App\\Http\\Controllers\\Master\\BuildingController',
                'route_active' => 1,
                'route_description' => null,
                'route_sort' => 1,
            ],
            [
                'route_code' => 'category',
                'route_name' => 'Category',
                'route_group' => 'master',
                'route_controller' => 'App\\Http\\Controllers\\Master\\CategoryController',
                'route_active' => 1,
                'route_description' => null,
                'route_sort' => 0,
            ],
            [
                'route_code' => 'filters',
                'route_name' => 'Filters',
                'route_group' => 'system',
                'route_controller' => 'App\\Http\\Controllers\\System\\FiltersController',
                'route_active' => 1,
                'route_description' => null,
                'route_sort' => 0,
            ],
            [
                'route_code' => 'groups',
                'route_name' => 'Groups',
                'route_group' => 'system',
                'route_controller' => 'App\\Http\\Controllers\\System\\GroupsController',
                'route_active' => 1,
                'route_description' => null,
                'route_sort' => 0,
            ],
            [
                'route_code' => 'location',
                'route_name' => 'Location',
                'route_group' => 'master',
                'route_controller' => 'App\\Http\\Controllers\\Master\\LocationController',
                'route_active' => 1,
                'route_description' => null,
                'route_sort' => 0,
            ],
            [
                'route_code' => 'product',
                'route_name' => 'Product',
                'route_group' => 'master',
                'route_controller' => 'App\\Http\\Controllers\\Master\\ProductController',
                'route_active' => 1,
                'route_description' => null,
                'route_sort' => 0,
            ],
            [
                'route_code' => 'roles',
                'route_name' => 'Roles',
                'route_group' => 'system',
                'route_controller' => 'App\\Http\\Controllers\\System\\RolesController',
                'route_active' => 1,
                'route_description' => null,
                'route_sort' => 0,
            ],
            [
                'route_code' => 'routes',
                'route_name' => 'Routes',
                'route_group' => 'system',
                'route_controller' => 'App\\Http\\Controllers\\System\\RoutesController',
                'route_active' => 1,
                'route_description' => null,
                'route_sort' => 1,
            ],
            [
                'route_code' => 'sparepart',
                'route_name' => 'Sparepart',
                'route_group' => 'master',
                'route_controller' => 'App\\Http\\Controllers\\Master\\SparepartController',
                'route_active' => 1,
                'route_description' => null,
                'route_sort' => 0,
            ],
            [
                'route_code' => 'tag',
                'route_name' => 'Tag',
                'route_group' => 'master',
                'route_controller' => 'App\\Http\\Controllers\\Master\\TagController',
                'route_active' => 1,
                'route_description' => null,
                'route_sort' => 0,
            ],
            [
                'route_code' => 'user',
                'route_name' => 'User',
                'route_group' => 'master',
                'route_controller' => 'App\\Http\\Controllers\\Master\\UserController',
                'route_active' => 1,
                'route_description' => null,
                'route_sort' => 0,
            ],
            [
                'route_code' => 'brand',
                'route_name' => 'Brand',
                'route_group' => 'master',
                'route_controller' => 'App\\Http\\Controllers\\Master\\BrandController',
                'route_active' => 1,
                'route_description' => null,
                'route_sort' => 0,
            ],
            [
                'route_code' => 'unit',
                'route_name' => 'Unit',
                'route_group' => 'master',
                'route_controller' => 'App\\Http\\Controllers\\Master\\UnitController',
                'route_active' => 1,
                'route_description' => null,
                'route_sort' => 0,
            ],
            [
                'route_code' => 'supplier',
                'route_name' => 'Supplier',
                'route_group' => 'master',
                'route_controller' => 'App\\Http\\Controllers\\Master\\SupplierController',
                'route_active' => 1,
                'route_description' => null,
                'route_sort' => 0,
            ],
            [
                'route_code' => 'department',
                'route_name' => 'Department',
                'route_group' => 'master',
                'route_controller' => 'App\\Http\\Controllers\\Master\\DepartmentController',
                'route_active' => 1,
                'route_description' => null,
                'route_sort' => 0,
            ],
            [
                'route_code' => 'work_type',
                'route_name' => 'Work Type',
                'route_group' => 'master',
                'route_controller' => 'App\\Http\\Controllers\\Master\\WorkTypeController',
                'route_active' => 1,
                'route_description' => null,
                'route_sort' => 1,
            ],
            [
                'route_code' => 'work_sheet',
                'route_name' => 'Work Sheet',
                'route_group' => 'transaction',
                'route_controller' => 'App\\Http\\Controllers\\Transaction\\WorkSheetController',
                'route_active' => 1,
                'route_description' => null,
                'route_sort' => 2,
            ],
            [
                'route_code' => 'ticket_topic',
                'route_name' => 'Ticket Topic',
                'route_group' => 'master',
                'route_controller' => 'App\\Http\\Controllers\\Master\\TicketTopicController',
                'route_active' => 1,
                'route_description' => null,
                'route_sort' => 1,
            ],
        ));

    }
}
