<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('class_id')->unsigned();
            $table->bigInteger('course_id')->unsigned();
            $table->bigInteger('teacher_id')->unsigned();
            $table->tinyInteger('day');
            $table->time('time');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('class_id')->on('tbl_classes')->references('id');
            $table->foreign('course_id')->on('tbl_courses')->references('id');
            $table->foreign('teacher_id')->on('users')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trans_schedules');
    }
}
