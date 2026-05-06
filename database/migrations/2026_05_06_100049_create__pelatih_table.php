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
        Schema::create('_pelatih', function (Blueprint $table) {
            $table->foreignId('userId')->constrained('users')->onDelete('cascade');
            $table->foreignId('stableId')->constrained('_stable')->onDelete('cascade');
            $table->boolean('isActive')->default(true);
            $table->timestamps();
            $table->softDeletes();
            $table->primary(['userId', 'stableId']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_pelatih');
    }
};
