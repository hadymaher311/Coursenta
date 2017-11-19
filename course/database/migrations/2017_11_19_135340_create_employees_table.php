<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email', 100)->unique();
            $table->string('username', 30)->unique();
            $table->string('password');
            $table->string('image');
            $table->string('mobile_number', 20)->nullable();
            $table->string('address')->nullable();
            $table->float('salary');
            $table->integer('branch_code')->unsigned();
            $table->foreign('branch_code')->references('code')->on('branches')->onDelete('restrict')->onUpdate('cascade');
            $table->string('position');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
