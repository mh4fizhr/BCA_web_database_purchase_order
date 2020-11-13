<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorymobilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historymobils', function (Blueprint $table) {
            $table->id();
            $table->string('po_id')->nullable();
            $table->string('mobil_id')->nullable();
            $table->string('Nopo')->nullable();
            $table->string('Hargasewamobil')->nullable();
            $table->string('tgl_update')->nullable();
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
        Schema::dropIfExists('historymobils');
    }
}
