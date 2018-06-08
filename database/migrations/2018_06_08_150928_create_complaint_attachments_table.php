<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComplaintAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('complaint_attachments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('comment_id');
            $table->integer('complaint_id');
            $table->string('attachment_location');

            // $table->foreign('complaint_id')
            //     ->references('id')
            //     ->on('complaints')
            //     ->onUpdate('cascade')
            //     ->onDelete('cascade');
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('complaint_attachments');
    }
}
