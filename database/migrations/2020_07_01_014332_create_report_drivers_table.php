<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_drivers', function (Blueprint $table) {
            $table->id();
            $table->string('driver_id')->nullable();
            $table->string('NamaDriver')->nullable();
            $table->string('nik')->nullable();
            $table->string('nip')->nullable();
            $table->string('Nopo')->nullable(); 
            $table->string('Sewa')->nullable();      
            $table->string('CP')->nullable();
            $table->string('Nopol')->nullable();
            $table->string('KodeCabang')->nullable();
            $table->string('NamaCabang')->nullable();
            $table->string('InisialCabang')->nullable();
            $table->string('CabangUtama')->nullable();          
            $table->string('StatusCabang')->nullable();
            $table->string('KWL')->nullable();
            $table->string('Kota')->nullable();
            $table->string('KodeMobil')->nullable();
            $table->string('MerekMobil')->nullable();
            $table->string('Tahun')->nullable();
            $table->string('Type')->nullable();
            $table->string('NamaVendor')->nullable();
            $table->string('tgl_mulai')->nullable();
            $table->string('tgl_selesai')->nullable();
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
        Schema::dropIfExists('report_drivers');
    }
}
