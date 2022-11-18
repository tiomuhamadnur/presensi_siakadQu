<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('class_id')->unsigned()->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('nip', 60)->nullable();
            $table->char('nik', 50)->nullable();
            $table->string('born_at', 100)->nullable();
            $table->date('birthday')->nullable();
            $table->char('phone', 20)->nullable();
            $table->enum('gender', ['Laki-laki', 'Perempuan']);
            $table->enum('role', ['admin', 'guru', 'siswa']);
            $table->char('nisn', 30)->nullable();
            $table->string('father_name')->nullable();
            $table->char('parent_phone', 20)->nullable();
            $table->string('address')->nullable();
            $table->string('photo')->nullable();
            $table->tinyInteger('status')->default('1');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}