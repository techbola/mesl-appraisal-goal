<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblAssetFault', function (Blueprint $table) {
            $table->increments('AssetFaultRef');
            $table->integer('AssetID');
            $table->string('AssetFault');
            $table->date('ReportDate')->nullable();
            $table->date('AcknowledgedDate')->nullable();
            $table->date('EstimatedReturnedDate')->nullable();
            $table->text('ConditionOnReturn');
            $table->integer('status');
            $table->decimal('EstimatedCost', 18, 2);
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
        Schema::dropIfExists('tblAssetFault');
    }
}
