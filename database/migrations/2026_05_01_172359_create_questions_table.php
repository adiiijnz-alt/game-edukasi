<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Pastikan tabel dihapus dulu jika ada untuk menghindari konflik
        Schema::dropIfExists('questions');
        
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('category'); 
            $table->string('title')->nullable();
            $table->json('elements'); 
            $table->string('answer'); 
            $table->text('options')->nullable(); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};