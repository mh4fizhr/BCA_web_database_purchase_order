<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportPkwtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_pkwts', function (Blueprint $table) {
            $table->id();
            $table->string('pkwt_id')->nullable();
            $table->string('driver_id')->nullable();
            $table->string('NamaDriver')->nullable();
            $table->string('nik')->nullable();
            $table->string('nip')->nullable();
            $table->string('NamaVendor')->nullable();
            $table->string('TanggalMasuk')->nullable();
            $table->string('pkwt1_start')->nullable();
            $table->string('pkwt1_end')->nullable();
            $table->string('pkwt2_start')->nullable();
            $table->string('pkwt2_end')->nullable();
            $table->string('DurasiJeda')->nullable();
            $table->string('PeriodeJeda_start')->nullable();
            $table->string('PeriodeJeda_end')->nullable();
            $table->string('Keterangan')->nullable();
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
        Schema::dropIfExists('report_pkwts');
    }
}
