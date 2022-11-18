<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('class_id')->unsigned();
            $table->bigInteger('course_id')->unsigned();
            $table->bigInteger('student_id')->unsigned();
            $table->float('mid_score')->default(0);
            $table->float('quiz_score')->default(0);
            $table->float('assesment_score')->default(0);
            $table->float('final_score')->default(0);
            $table->float('total_score')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('class_id')->on('tbl_classes')->references('id');
            $table->foreign('course_id')->on('tbl_courses')->references('id');
            $table->foreign('student_id')->on('users')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trans_courses');
    }
}