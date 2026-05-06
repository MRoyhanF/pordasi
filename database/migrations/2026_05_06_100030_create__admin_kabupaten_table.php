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
        Schema::create('_admin_kabupaten', function (Blueprint $table) {
            $table->foreignId('idUser')->constrained('users')->onDelete('cascade');
            $table->foreignId('idKabupaten')->constrained('kabupaten')->onDelete('cascade');
            $table->boolean('isActive')->default(true);
            $table->timestamps();
            $table->softDeletes();
            $table->primary(['idUser', 'idKabupaten']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_admin_kabupaten');
    }
};
