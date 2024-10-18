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
            $table->string('editorial')->nullable();
            $table->integer('anyEdicio')->nullable();
            $table->string('genere')->nullable();
            $table->string('ubicacio')->nullable();
            $table->string('idioma')->nullable();
            // $table->boolean('deixat');
            $table->string('coleccio')->nullable();
            $table->string('portada')->nullable();
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
