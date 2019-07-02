<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppraisalLearningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appraisal_learnings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('staffID')->unsigned();
            $table->integer('supervisorID')->unsigned();
            $table->integer('appraisal_id')->unsigned();

            $table->string('objective');
            $table->string('kpi');
            $table->string('target');
            $table->decimal('selfAssessment', 3,1)->nullable();
            $table->string('constraint');

            $table->decimal('weight', 3,1)->nullable();
            $table->decimal('supervisorAssessment',3,1)->nullable();
            $table->string('justification')->nullable();
            $table->string('hrComment')->nullable();

            $table->string('supervisorAppraisalComment')->nullable();
            $table->string('hrAppraisalComment')->nullable();
            $table->string('staffAppraisalComment')->nullable();

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
        Schema::dropIfExists('appraisal_learnings');
    }
}
