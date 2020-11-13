<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_services', function (Blueprint $table) {
            $table->id();
            $table->string('service_id')->nullable(); 
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
            $table->string('nik')->nullable();
            $table->string('nip')->nullable();
            $table->string('NamaDriver')->nullable();
            $table->string('periode')->nullable();
            $table->string('TglService')->nullable();
            $table->string('km')->nullable();
            $table->string('Keterangan')->nullable();
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
        Schema::dropIfExists('report_services');
    }
}
