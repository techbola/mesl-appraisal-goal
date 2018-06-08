<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComplaintCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaint_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('complaint_id');
            $table->foreign('complaint_id')->references('id')->on('complaints')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('comment', 255)->nullable();
            $table->string('status', 50)->nullable();
            $table->boolean('has_cost')->default(0);
            $table->decimal('cost', 18, 2);

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
        Schema::dropIfExists('complaint_comments');
    }
}
