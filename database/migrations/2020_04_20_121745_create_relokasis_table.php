<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelokasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relokasis', function (Blueprint $table) {
            $table->id();
            $table->string('Po_id')->nullable();
            $table->string('Cabang_id_lama')->nullable();
            $table->string('Cabang_id')->nullable();
            $table->string('Nopo_relokasi')->nullable();
            $table->string('Efisien_relokasi')->nullable();
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
        Schema::dropIfExists('relokasis');
    }
}
