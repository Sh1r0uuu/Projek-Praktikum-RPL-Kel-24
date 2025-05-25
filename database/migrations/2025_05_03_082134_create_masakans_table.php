<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('masakans', function (Blueprint $table) {
            $table->id('id_Masakan');
            $table->string('nama_Masakan');
            $table->string('gambar_Masakan')->nullable();
            $table->text('deskripsi_Resep');
            $table->text('bahan_Memasak');
            $table->text('detail_Resep');
            $table->string('kategori_Masakan');
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('masakans');
    }
};
