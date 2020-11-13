<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBackupPengurangansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('backup_pengurangans', function (Blueprint $table) {
            $table->id();
            $table->string('po_id')->nullable();
            $table->string('template_id')->nullable();
            $table->string('table_template_id')->nullable();
            $table->string('Sewa')->nullable();
            $table->string('Sewa_sementara')->nullable();
            $table->string('NoPo')->nullable();
            $table->string('Nopo_pengurangan')->nullable();
            $table->string('Pengurangan')->nullable();
            $table->string('Tgl_cutoff')->nullable();
            $table->string('Tgl_cutoff_driver')->nullable();
            $table->string('Hargasewamobil')->nullable();
            $table->string('Hargasewadriver')->nullable();
            $table->string('Hargasewamobildriver')->nullable();
            $table->string('Driver_id')->nullable();
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
        Schema::dropIfExists('backup_pengurangans');
    }
}
