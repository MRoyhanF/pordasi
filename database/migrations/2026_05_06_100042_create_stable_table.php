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
        Schema::create('stable', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idKabupaten')->constrained('kabupaten')->onDelete('cascade');
            $table->string('nama');
            $table->year('mulai_berdiri')->nullable();
            $table->string('pemilik');
            $table->text('alamat_ktp_pemilik')->nullable();
            $table->text('alamat_stable');
            $table->string('pimpinan_stable');
            $table->string('no_akte_badan_hukum')->nullable();
            $table->string('no_pengesahan_kumham')->nullable();
            $table->string('npwp')->nullable();
            $table->text('domisili_badan_hukum')->nullable();
            $table->integer('jumlah_kandang')->nullable();
            $table->string('frameMap')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stable');
    }
};
