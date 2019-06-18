<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TimeAndAttachmentForTodos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tblTodo', function (Blueprint $table) {
            $table->time('StartTime')->nullable();
            $table->time('EndTime')->nullable();
        });
        Schema::create('tblTodoFiles', function (Blueprint $table) {
            $table->increments('TodoFileRef');
            $table->string('Filename')->nullable();
            $table->integer('TodoID')->nullable();
            $table->integer('InputterID')->nullable();
            $table->timestamps();
        });
        Schema::create('tblTodoAssignees', function (Blueprint $table) {
          $table->integer('TodoID');
          $table->integer('UserID');

          $table->primary(['TodoID', 'UserID']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tblTodo', function (Blueprint $table) {
            $table->dropColumn('StartTime');
            $table->dropColumn('EndTime');
        });
        Schema::dropIfExists('tblTodoFiles');
        Schema::dropIfExists('tblTodoAssignees');
    }
}
