<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tpos', function (Blueprint $table) {
            $table->id();
            $table->string('Sewa')->nullable();      
            $table->string('CP')->nullable();
            $table->string('Cabang_id')->nullable(); 
            $table->string('Ump_id')->nullable();
            $table->string('Mobil_id')->nullable();
            $table->string('Type')->nullable();
            $table->string('Nopol')->nullable();
            $table->string('Vendor_Mobil')->nullable();
            $table->string('Vendor_Driver')->nullable();
            $table->string('Driver_id')->nullable();
            $table->string('UserPengguna')->nullable();
            $table->string('NoPo')->nullable();
            $table->string('MulaiSewa')->nullable();
            $table->string('MulaiSewa2')->nullable();
            $table->string('Tgl_bastk')->nullable();
            $table->string('Tgl_bastd')->nullable();
            $table->string('Tgl_relokasi')->nullable();
            $table->string('Nopo_relokasi')->nullable();
            $table->string('Efisien_relokasi')->nullable();
            $table->string('Cabang_relokasi')->nullable();
            $table->string('Hargasewadriver_relokasi')->nullable();
            $table->string('Pengurangan')->nullable();
            $table->string('Sewa_sementara')->nullable();
            $table->string('Nopo_pengurangan')->nullable();
            $table->string('Hargasewamobil_pengurangan')->nullable();
            $table->string('Tgl_cutoff')->nullable();
            $table->string('Tgl_cutoff_driver')->nullable();
            $table->string('SelesaiSewa')->nullable();
            $table->string('SelesaiSewa2')->nullable();
            $table->string('HargaSewaMobil')->nullable();
            $table->string('HargaSewaDriver2019')->nullable();
            $table->string('HargaSewaMobilDriver')->nullable();
            $table->string('status')->default("0");
            $table->string('NoRegister')->nullable();
            $table->string('Po_multiple_start')->nullable();
            $table->string('Po_multiple_end')->nullable();
            $table->string('Nopo_permanent')->nullable();
            $table->string('Cabang_permanent')->nullable();
            $table->string('Sewa_permanent')->nullable();
            $table->string('bbm')->nullable();
            $table->string('jenis_bbm')->nullable();
            $table->string('data_pairing_baru')->nullable();
            $table->string('tgl_efektif_perubahan')->nullable();
            $table->string('Nopo_perubahan')->nullable();
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
        Schema::dropIfExists('tpos');
    }
}
