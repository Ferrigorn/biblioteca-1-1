<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('llibres', function (Blueprint $table) {
            $table->id();
            $table->string('titol');
            $table->string('autor');
            $table->string('editorial');
            $table->integer('anyEdicio');
            $table->string('genere');
            $table->string('ubicacio');
            $table->string('idioma');
            // $table->boolean('deixat');
            $table->string('coleccio');
            $table->string('portada');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('llibres');
    }
};
