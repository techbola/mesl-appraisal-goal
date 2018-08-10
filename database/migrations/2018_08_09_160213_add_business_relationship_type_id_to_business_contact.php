<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBusinessRelationshipTypeIdToBusinessContact extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tblContacts', function (Blueprint $table) {
            $table->integer('RelationshipTypeID')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tblContacts', function (Blueprint $table) {
            $table->dropColumn(['RelationshipTypeID']);
        });
    }
}
