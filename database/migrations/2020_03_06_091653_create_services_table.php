<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('periode')->nullable();
            $table->string('po_id')->nullable();
            $table->string('mobil_id')->nullable();
            $table->string('cabang_id')->nullable();
            $table->string('vendor_id')->nullable();
            $table->string('driver_id')->nullable();
            $table->string('TglService')->nullable();
            $table->string('km')->nullable();
            $table->string('Keterangan')->nullable();
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
        Schema::dropIfExists('services');
    }
}
