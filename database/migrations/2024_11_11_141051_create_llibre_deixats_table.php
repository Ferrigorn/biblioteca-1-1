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
        Schema::create('llibres_deixats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('llibre_id')->constrained()->onDelete('cascade'); // Referència al llibre deixat
            $table->string('a_qui'); // Nom de la persona a qui es deixa
            $table->date('quan'); // Data en què es deixa
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('llibre_deixats');
    }
};
