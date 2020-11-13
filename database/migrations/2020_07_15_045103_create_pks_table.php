<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pks', function (Blueprint $table) {
            $table->id();
            $table->string('vendor')->nullable();
            $table->string('no_pks')->nullable();
            $table->string('tgl_pks')->nullable();
            $table->string('nama_kontrak_pks')->nullable();
            $table->string('addendum_id')->nullable();
            $table->string('deskripsi')->nullable();
            $table->string('file')->nullable();
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
        Schema::dropIfExists('pks');
    }
}
