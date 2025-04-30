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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('title');        // Judul resep, misal: Greek Salad
            $table->string('category');     // Kategori, misal: Salad
            $table->string('origin');       // Asal resep, misal: Mediterranean
            $table->string('image')->nullable();   // URL/path ke gambar resep
            $table->string('time');         // Waktu masak, misal: 15 mins
            $table->string('type');         // Tipe makanan, misal: Main Course
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
