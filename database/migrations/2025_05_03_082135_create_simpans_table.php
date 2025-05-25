<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('simpans', function (Blueprint $table) {
            $table->id('id_Simpan');
            $table->foreignId('id_User')->constrained('users', 'id_User')->onDelete('cascade');
            $table->foreignId('id_Masakan')->constrained('masakans', 'id_Masakan')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('simpans');
    }
};
