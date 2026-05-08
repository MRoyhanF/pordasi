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
        Schema::create('atlet', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->enum('level', ['Mula', 'Madya', 'Wira']);
            $table->enum('jenisKelamin', ['Pria', 'Wanita']);
            $table->foreignId('idStable')->constrained('stable')->onDelete('cascade');
            $table->string('alamat')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atlet');
    }
};
