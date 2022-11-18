<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->bigInteger('teacher_id')->unsigned();
            $table->bigInteger('class_id')->unsigned();
            $table->char('schedule', 10)->default('senin');
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('teacher_id')->on('users')->references('id');
            $table->foreign('class_id')->on('tbl_classes')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_courses');
    }
}