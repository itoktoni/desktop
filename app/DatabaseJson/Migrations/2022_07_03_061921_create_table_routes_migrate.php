<?php

namespace App\DatabaseJson\Migrations;

use DatabaseJson\DatabaseJson;
use DatabaseJson\Migration;

class CreateTableRoutesMigrate extends Migration
{
    /**
     * How to create table
     *
     * DatabaseJson::table('NameTable',array(
     *  {field_name} => {field_type} More information about field types and usage in PHPDoc
     * ));
     */

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DatabaseJson::create('routes', array(
            'route_group' => 'string',
            'route_name' => 'string',
            'route_slug' => 'string',
            'route_active' => 'integer',
            'route_controller' => 'string',
            'route_description' => 'string',
            'created_at' => 'string',
            'updated_at' => 'string',
        ));
    }
}
