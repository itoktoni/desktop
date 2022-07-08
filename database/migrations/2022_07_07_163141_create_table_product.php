<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->bigIncrements('product_id');
            $table->string('product_name');
            $table->string('product_code')->nullable();
            $table->string('product_image')->nullable();
            $table->string('product_category_id')->nullable();
            $table->string('product_brand_id')->nullable();
            $table->string('product_unit_id')->nullable();
            $table->tinyInteger('product_active')->default(1);
            $table->text('product_description')->nullable();
            $table->dateTime('product_created_at')->nullable();
            $table->dateTime('product_updated_at')->nullable();
            $table->dateTime('product_deleted_at')->nullable();
            $table->integer('product_deleted_by')->nullable();
            $table->integer('product_updated_by')->nullable();
            $table->integer('product_created_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
