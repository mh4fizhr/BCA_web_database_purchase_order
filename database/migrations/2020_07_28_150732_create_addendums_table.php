<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddendumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addendums', function (Blueprint $table) {
            $table->id();
            $table->string('vendor')->nullable();
            $table->string('pks_id')->nullable();
            $table->string('no_addendum')->nullable();
            $table->string('tgl_addendum')->nullable();
            $table->string('nama_kontrak_addendum')->nullable();
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
        Schema::dropIfExists('addendums');
    }
}
