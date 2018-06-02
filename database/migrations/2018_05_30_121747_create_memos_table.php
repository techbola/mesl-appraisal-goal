<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('request_type_id');
            $table->string('subject')->nullable();
            $table->string('purpose')->nullable();
            $table->text('body');

            $table->boolean('ApprovedFlag')->default(0);
            $table->boolean('NotifyFlag')->default(0);
            $table->date('ApprovalDate')->nullable();
            $table->text('ApproverComment')->nullable();
            $table->integer('ModuleID')->default(2);
            $table->integer('ApproverID')->storedAs('ApproverID1');
            $table->integer('ApproverID1')->nullable();
            $table->integer('ApproverID2')->nullable();
            $table->integer('ApproverID3')->nullable();
            $table->integer('ApproverID4')->nullable();
            $table->integer('ApproverID5')->nullable();
            $table->integer('ApproverID6')->nullable();
            $table->integer('ApproverID7')->nullable();
            $table->integer('ApproverID8')->nullable();
            $table->integer('ApproverID9')->nullable();
            $table->integer('ApproverID10')->nullable();
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
        Schema::dropIfExists('memos');
    }
}
