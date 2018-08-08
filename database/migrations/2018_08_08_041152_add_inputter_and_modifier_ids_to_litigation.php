<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInputterAndModifierIdsToLitigation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tblLitigation', function (Blueprint $table) {
            $table->integer('InputterID')->nullable();
            $table->integer('ModifierID')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tblLitigation', function (Blueprint $table) {
            $table->dropColumn(['InputterID', 'ModifierID']);
        });
    }
}
