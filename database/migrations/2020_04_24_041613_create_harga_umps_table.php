<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHargaUmpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('harga_umps', function (Blueprint $table) {
            $table->id();
            $table->string('Kota_id')->nullable();
            $table->string('Tahun_id')->nullable();
            $table->string('Jkk_id')->nullable();
            $table->string('Vendor_id')->nullable();
            $table->string('Harga_include')->nullable();
            $table->string('Harga_eksclude')->nullable();
            $table->string('toggle')->nullable();
            $table->string('activated')->nullable();
            $table->string('active')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
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
        Schema::dropIfExists('harga_umps');
    }
}
