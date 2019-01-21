<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIdentityCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('identity_cards', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('staff_id');
            $table->integer('department_id');
            $table->string('passport_path');
            $table->string('staff_id_number');
            $table->string('expected_request_date');
            $table->integer('first_approver_id');
            $table->boolean('first_approver_status', false);
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
        Schema::dropIfExists('identity_cards');
    }
}
