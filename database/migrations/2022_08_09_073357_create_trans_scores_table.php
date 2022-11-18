<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_scores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('trans_course_id')->unsigned();
            $table->tinyInteger('number')->default('1');
            $table->string('name');
            $table->float('score');
            $table->float('percent')->nullable();
            $table->string('description');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('trans_course_id')->on('trans_courses')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trans_scores');
    }
}