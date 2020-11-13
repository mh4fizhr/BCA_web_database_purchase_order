<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportSalonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_salons', function (Blueprint $table) {
            $table->id();
            $table->string('salon_id')->nullable(); 
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
            $table->string('Salon1')->nullable();
            $table->string('Salon2')->nullable();
            $table->string('Status')->nullable();
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
        Schema::dropIfExists('report_salons');
    }
}
