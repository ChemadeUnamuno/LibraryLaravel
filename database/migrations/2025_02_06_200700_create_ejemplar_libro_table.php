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
        Schema::create('ejemplar_libros', function (Blueprint $table) {
            $table->increments('id_ejemplar');
            $table->string('titulo', 100)->unique();
            $table->string('autor', 50);
            $table->string('editorial', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ejemplar_libros');
    }
};
