<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffBehaviouralItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_behavioural_items', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('staffID')->unsigned();
            $table->integer('supervisorID')->unsigned();

            $table->integer('appraisal_id')->unsigned();

            $table->integer('behaviouralCat_id')->unsigned();
            $table->integer('behaviouralItem_id')->unsigned();

            $table->integer('selfAssessment')->nullable();
            $table->integer('supervisorAssessment')->nullable();
            $table->string('supervisorComment')->nullable();
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
        Schema::dropIfExists('staff_behavioural_items');
    }
}
