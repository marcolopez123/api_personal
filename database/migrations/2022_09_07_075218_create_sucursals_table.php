<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sucursals', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->foreignId('empresa_id')->nullable()->constrained('empresa');
            $table->foreignId('pais_id')->nullable()->constrained('pais');
            $table->foreignId('region_id')->nullable()->constrained('region');
            $table->foreignId('comuna_id')->nullable()->constrained('comuna');
            $table->string('direccion')->nullable();
            $table->string('telefono')->nullable();
            $table->string('documento')->nullable();
            $table->string('impresora')->nullable();
            $table->string('impresora_url')->nullable();

            $table->integer('estado')->default(1);
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
        Schema::dropIfExists('sucursals');
    }
};
