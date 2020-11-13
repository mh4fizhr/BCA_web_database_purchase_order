<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUmpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('umps', function (Blueprint $table) {
            $table->id();
            $table->string('Kota');
            $table->string('Daerah1');
            $table->string('Daerah2');
            $table->string('ASSA');
            $table->string('TUNAS');
            $table->string('TRAC');
            $table->string('MPM');
            $table->string('SRIKANDI');
            $table->string('INDORENT');
            $table->string('HIBA');
            $table->string('UNIVERSAL');
            $table->string('BLUE_BIRD');
            $table->string('Number');
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
        Schema::dropIfExists('umps');
    }
}
