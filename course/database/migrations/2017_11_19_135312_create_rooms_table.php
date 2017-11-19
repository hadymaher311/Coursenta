<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->integer('number')->unsigned();
            $table->integer('branch_code')->unsigned();
            $table->primary(['number', 'branch_code']);
            $table->foreign('branch_code')->references('code')->on('branches')->onDelete('cascade')->onUpdate('cascade')->primary();
            $table->integer('capacity');
            $table->boolean('availability')->default(1);
            $table->boolean('AC')->default(1);
            $table->boolean('projector')->default(1);
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
        Schema::dropIfExists('rooms');
    }
}
