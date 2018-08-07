<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLitigationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbllitigations', function (Blueprint $table) {
            $table->increments('LitigationRef');
            $table->string('CaseNumber', 50);
            $table->string('Parties')->nullable();
            $table->integer('CourtID');
            $table->integer('ContactID'); // should be based on department
            $table->text('Comment'); //
            $table->int('Status', 1)->default(0);
            $table->datetime('StatusDate');
            $table->datetime('AdjournmentDate');
            $table->decimal('EstimatedFineAmountAgainst', 18, 2);
            $table->decimal('ActualFineAmountAgainst', 18, 2);
            $table->decimal('EstimatedFineAmountInFavour', 18, 2);
            $table->decimal('ActualFineAmountInFavour', 18, 2);
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
        Schema::dropIfExists('tbllitigations');
    }
}
