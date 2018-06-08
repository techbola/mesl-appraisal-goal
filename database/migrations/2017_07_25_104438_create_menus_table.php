<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('route')->nullable();
            $table->string('parent_id')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('menu_role', function (Blueprint $table) {
            $table->integer('menu_id')->unsigned();
            $table->integer('role_id')->unsigned();

            $table->foreign('menu_id')->references('id')->on('menus')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['menu_id', 'role_id']);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('menu_role', function (Blueprint $table) {
        $table->dropForeign('menu_role_menu_id_foreign');
        $table->dropForeign('menu_role_role_id_foreign');
      });
      Schema::dropIfExists('menus');
      Schema::dropIfExists('menu_role');

    }
}
