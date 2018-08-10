<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetMaintenancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblAssetMaintenance', function (Blueprint $table) {
            $table->increments('AssetMaintenanceRef');
            $table->integer('AssetID');
            $table->integer('MaintenanceInterval');
            $table->date('LastMaintenanceDate');
            $table->date('NextMaintenanceDate');
            $table->integer('ContactID'); // from contacts
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
        Schema::dropIfExists('tblAssetMaintenance');
    }
}
