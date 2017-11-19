<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimetablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timetables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('room_number')->unsigned();
            $table->foreign('room_number')->references('number')->on('rooms')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('branch_code')->unsigned();
            $table->foreign('branch_code')->references('branch_code')->on('rooms')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('course_code')->unsigned();
            $table->foreign('course_code')->references('code')->on('courses')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamp('start_time');
            $table->timestamp('end_time')->nullable();
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
        Schema::dropIfExists('timetables');
    }
}
