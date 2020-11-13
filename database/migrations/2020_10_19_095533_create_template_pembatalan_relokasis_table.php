<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplatePembatalanRelokasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('template_pembatalan_relokasis', function (Blueprint $table) {
            $table->id();
            $table->string('template_id')->nullable();
            $table->string('template_surat_id')->nullable();
            $table->string('tgl_pembatalan')->nullable();
            $table->string('nama_unit_kerja')->nullable();
            $table->string('kode_unit_kerja')->nullable();
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
        Schema::dropIfExists('template_pembatalan_relokasis');
    }
}
