<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRiskRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('risk_registers', function (Blueprint $table) {
            $table->increments('id');
            $table->text('risk_description')->nullable();
            $table->integer('risk_score')->default(0);
            $table->string('risk_rating')->storeAs(
                if ('risk_score' >= 80) {
                    return 'Extreme'
                }
            )->nullable();
            $table->integer('risk_type')->nullable();
            $table->date('last_assessed_date');
            $table->text('controls')->nullable();
            $table->integer('control_effectiveness_score')->default(0);
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
        Schema::dropIfExists('risk_registers');
    }
}
