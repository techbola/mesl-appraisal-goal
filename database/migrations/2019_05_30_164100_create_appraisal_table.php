<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppraisalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appraisal', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->integer('staffID')->unsigned();
            $table->integer('supervisorID')->unsigned();
            $table->integer('hrID')->unsigned()->nullable();

            $table->string('employee_name');
            $table->string('job_position')->nullable();
            $table->string('department')->nullable();
            $table->string('period');

            $table->boolean('sentFlag')->default(0);
            $table->integer('status')->default(0);
            $table->text('supervisorComment')->nullable();

            $table->string('appraiserDesignation')->nullable();
            $table->string('appraiserName')->nullable();

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
        Schema::dropIfExists('appraisal');
    }
}
