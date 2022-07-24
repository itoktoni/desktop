<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkSheetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_sheet', function (Blueprint $table) {
            $table->string('work_sheet_code')->primary();
            $table->integer('work_sheet_type_id')->nullable(); //(relation work_type)
            $table->string('work_sheet_name');
            $table->text('work_sheet_description');
            $table->text('work_sheet_check');
            $table->text('work_sheet_result');
            $table->string('work_sheet_ticket_code')->nullable(); //(relation ticket)(Feature)
            $table->integer('work_sheet_product_id')->nullable(); //(relation product)
            $table->dateTime('work_sheet_reported_at')->nullable();
            $table->string('work_sheet_reported_by')->nullable();
            $table->dateTime('work_sheet_created_at')->nullable();
            $table->string('work_sheet_created_by')->nullable();
            $table->dateTime('work_sheet_updated_at')->nullable();
            $table->string('work_sheet_updated_by')->nullable();
            $table->dateTime('work_sheet_deleted_at')->nullable();
            $table->string('work_sheet_deleted_by')->nullable();
            $table->dateTime('work_sheet_finished_at')->nullable();
            $table->string('work_sheet_finished_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('work_sheet');
    }
}
