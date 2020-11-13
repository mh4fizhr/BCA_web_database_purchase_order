<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplatePerubahansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('template_perubahans', function (Blueprint $table) {
            $table->id();
            $table->string('no_surat')->nullable();
            $table->string('tgl_surat')->nullable();
            $table->string('nama_vendor')->nullable();
            $table->string('pic_vendor')->nullable();
            $table->string('jabatan_vendor')->nullable();
            $table->string('alamat_vendor')->nullable();
            $table->string('sewa')->nullable();
            $table->string('pks')->nullable();
            $table->string('no_pks')->nullable();
            $table->string('tgl_pks')->nullable();
            $table->string('jml_mobil')->nullable();
            $table->string('jml_driver')->nullable();
            $table->string('unitkerja_pb1')->nullable();
            $table->string('unitkerja_pb2')->nullable();
            $table->string('nama_pb1')->nullable();
            $table->string('nama_pb2')->nullable();
            $table->string('jabatan_pb1')->nullable();
            $table->string('jabatan_pb2')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('template_perubahans');
    }
}
