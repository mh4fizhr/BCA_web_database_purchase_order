<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salons', function (Blueprint $table) {
            $table->id();
            $table->string('periode')->nullable();
            $table->string('po_id')->nullable();
            $table->string('mobil_id')->nullable();
            $table->string('cabang_id')->nullable();
            $table->string('vendor_id')->nullable();
            $table->string('driver_id')->nullable();
            $table->string('Salon1')->nullable();
            $table->string('Salon2')->nullable();
            $table->string('Status')->default('1');
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
        Schema::dropIfExists('salons');
    }
}
