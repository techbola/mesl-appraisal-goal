<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StateOfMarriage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tblStaff', function(Blueprint $table){
          $table->integer('StateOfMarriage')->nullable()->after('DateOfMarriage');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tblStaff', function(Blueprint $table){
          $table->dropColumn('StateOfMarriage');
        });
    }
}
