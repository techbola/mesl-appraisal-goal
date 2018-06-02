<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExtraFlagsAndFieldsForMemos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('memos', function (Blueprint $table) {
            $table->string('receipients')->nullable();
            // $table->dropColumn(['recipient_id']);
            $table->boolean('ProcessedFlag')->default(0);
            $table->integer('ProcessedBy')->nullable();
            $table->date('ProcessedDate')->nullable();
        });
    }

    public function down()
    {
        Schema::table('memos', function (Blueprint $table) {
            // $table->integer('recipient_id')->nullable();
            $table->dropColumn(['receipients', 'ProcessedBy', 'ProcessedDate']);
            $table->dropColumn(['ProcessedFlag']);
        });
    }
}
