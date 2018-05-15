<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Officemate extends Migration
{

    public function up()
    {
      // Staff
      Schema::create('tblStaff', function (Blueprint $table) {
          $table->increments('StaffRef');
          $table->integer('UserID')->unique();
          $table->string('CompanyID');
          $table->string('MobilePhone')->nullable();
          $table->timestamps();
      });
      // Gender
      Schema::create('tblGender', function (Blueprint $table) {
          $table->increments('GenderRef');
          $table->string('Gender')->unique();
          $table->timestamps();
      });
      // Staff
      Schema::create('tblCompany', function (Blueprint $table) {
          $table->increments('CompanyRef');
          $table->string('Company');
          $table->string('Slug')->unique();
          $table->string('Logo')->nullable();
          $table->string('Color1')->nullable();
          $table->string('Color2')->nullable();
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
      Schema::dropIfExists('tblStaff');
      Schema::dropIfExists('tblGender');
      Schema::dropIfExists('tblCompany');
    }
}
