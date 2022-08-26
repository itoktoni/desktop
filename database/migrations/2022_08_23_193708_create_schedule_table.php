<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule', function (Blueprint $table) {
            $table->bigIncrements('schedule_id');
            $table->string('schedule_name');
            $table->integer('schedule_product_id');
            $table->text('schedule_description')->nullable();
            $table->integer('schedule_number'); //(integer)
            $table->dateTime('schedule_every')->nullable(); // (type hour, day, month, year)
            $table->date('schedule_date'); // (date)
            $table->tinyInteger('schedule_notification'); //(tiny integer : 1=yes , 2=no)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedule');
    }
}
