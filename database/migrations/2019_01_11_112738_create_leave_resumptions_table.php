<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaveResumptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_resumptions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('staff_id');
            $table->integer('department_id');
            $table->integer('office_id');
            $table->integer('supervisor_id');
            $table->date('leave_commernce_date');
            $table->date('leave_resume_date');
            $table->string('leave_days_taken');
            $table->string('leave_days_used');
            $table->string('leave_days_left');
            $table->date('date_resume');
            $table->text('reason_for_resumption')->nullable();
            $table->text('supervisor_remark')->nullable();
            $table->boolean('is_approved', false);
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
        Schema::dropIfExists('leave_resumptions');
    }
}
