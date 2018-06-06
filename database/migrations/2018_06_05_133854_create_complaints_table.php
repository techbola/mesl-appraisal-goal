<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id');
            $table->string('allocation');
            $table->integer('location_id');
            $table->string('findings', 255)->nullable(); // comments
            $table->decimal(18, 4)->nullable();
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
        Schema::dropIfExists('complaints');
    }
}
