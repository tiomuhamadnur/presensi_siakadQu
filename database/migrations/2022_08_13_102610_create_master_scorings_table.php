<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterScoringsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_scorings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('tbl_course_id')->unsigned();
            $table->string('name');
            $table->float('percent');
            $table->float('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_scorings');
    }
}
