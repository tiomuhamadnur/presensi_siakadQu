<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_classes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('code', 20);
            $table->string('name');
            $table->bigInteger('teacher_guider_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('teacher_guider_id')->on('users')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_classes');
    }
}
