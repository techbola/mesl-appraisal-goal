<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffAppraisalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_appraisals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('staff_id')->unsigned();
            $table->integer('appraisal_id')->unsigned();

            $table->integer('staffFinancialScore');
            $table->integer('staffCustomerScore');
            $table->integer('staffInternalScore');
            $table->integer('staffLearningScore');
            $table->integer('supervisorFinancialScore');
            $table->integer('supervisorCustomerScore');
            $table->integer('supervisorInternalScore');
            $table->integer('supervisorLearningScore');
            $table->integer('bscStaffScore');
            $table->integer('bscSupervisorScore');
            $table->integer('staffBehavioural');
            $table->integer('supervisorBehavioural');
            $table->integer('overallStaffScore');
            $table->integer('overallSupervisorScore');

            $table->string('period');

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
        Schema::dropIfExists('staff_appraisals');
    }
}
