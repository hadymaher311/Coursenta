<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('code');
            $table->string('name')->unique();
            $table->float('cost');
            $table->float('offer_cost')->nullable();
            $table->text('description');
            $table->integer('sessions_number');
            $table->integer('professor_id')->unsigned();
            $table->foreign('professor_id')->references('id')->on('professors')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('courses');
    }
}
