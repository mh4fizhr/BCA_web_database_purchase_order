<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTemplatePerubahansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_template_perubahans', function (Blueprint $table) {
            $table->id();
            $table->string('template_id')->nullable();
            $table->string('po_id')->nullable();
            $table->string('nama_cabang')->nullable();
            $table->string('kode_cabang')->nullable();
            $table->string('merek')->nullable();
            $table->string('nopol')->nullable();
            $table->string('data_pairing_lama')->nullable();
            $table->string('data_pairing_baru')->nullable();
            $table->string('tgl_efektif')->nullable();
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
        Schema::dropIfExists('table_template_perubahans');
    }
}
