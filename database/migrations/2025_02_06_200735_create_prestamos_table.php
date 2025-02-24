<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('prestamos', function (Blueprint $table) {
            $table->integer('id_socio')->unsigned();
            $table->integer('id_ejemplar')->unsigned();
            $table->date('fecha_prestamo');
            $table->timestamps();

            $table->foreign('id_socio')->references('id')->on('users');
            $table->foreign('id_ejemplar')->references('id_ejemplar')->on('ejemplar_libros');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestamos');
    }
};
