<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBehaviouralItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('behavioural_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('behaviouralCat_id')->unsigned();
            $table->integer('level_id')->unsigned();
            $table->string('behaviouralItem');
            $table->integer('weight');
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
        Schema::dropIfExists('behavioural_items');
    }
}
