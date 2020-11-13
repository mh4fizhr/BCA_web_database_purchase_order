<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengurangansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengurangans', function (Blueprint $table) {
            $table->id();
            $table->string('Po_id')->nullable();
            $table->string('Nopo_pengurangan')->nullable();
            $table->string('pengurangan')->nullable();
            $table->string('penambahan')->nullable();
            $table->string('perubahan')->nullable();
            $table->string('tgl_cutoff')->nullable();
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
        Schema::dropIfExists('pengurangans');
    }
}
