<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransPresentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_presents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('trans_course_id')->unsigned();
            $table->tinyInteger('status')->default(0);
            $table->string('description');
            $table->dateTime('on');
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
        Schema::dropIfExists('trans_presents');
    }
}