<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('KodeVendor');
            $table->string('NamaVendor')->nullable()->unique();
            $table->string('PICvendor')->nullable();
            $table->string('Nohpvendor')->nullable();
            $table->string('Pejabatvendor')->nullable();
            $table->string('Jabatanvendor')->nullable();
            $table->string('AlamatVendor')->nullable();
            $table->string('active')->nullable();
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
        Schema::dropIfExists('vendors');
    }
}
