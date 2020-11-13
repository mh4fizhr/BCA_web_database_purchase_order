<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportDatabasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_databases', function (Blueprint $table) {
            $table->id();
            $table->string('po_id')->nullable();
            $table->string('Nopo')->nullable(); 
            $table->string('Sewa')->nullable();      
            $table->string('CP')->nullable();
            $table->string('KodeCabang')->nullable();
            $table->string('NamaCabang')->nullable();
            $table->string('InisialCabang')->nullable();
            $table->string('CabangUtama')->nullable();          
            $table->string('StatusCabang')->nullable();
            $table->string('KWL')->nullable();
            $table->string('Kota')->nullable();
            $table->string('KodeMobil')->nullable();
            $table->string('MerekMobil')->nullable();
            $table->string('Type')->nullable();
            $table->string('Nopol')->nullable();
            $table->string('Tahun')->nullable();
            $table->string('NamaVendor')->nullable();
            $table->string('NamaDriver')->nullable();
            $table->string('nik')->nullable();
            $table->string('nip')->nullable();
            $table->string('MulaiSewa')->nullable();
            $table->string('Tgl_bastk')->nullable();
            $table->string('Tgl_bastd')->nullable();
            $table->string('Tgl_relokasi')->nullable();
            $table->string('SelesaiSewa')->nullable();
            $table->string('Hargasewamobil')->nullable();
            $table->string('Hargasewadriver')->nullable();
            $table->string('Hargasewamobildriver')->nullable();
            $table->string('bbm')->nullable();
            $table->string('jenis_bbm')->nullable();
            $table->string('No_register')->nullable();
            $table->string('UserPengguna')->nullable();
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
        Schema::dropIfExists('report_databases');
    }
}
