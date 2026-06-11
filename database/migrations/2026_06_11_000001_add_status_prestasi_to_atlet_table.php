<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('atlet', function (Blueprint $table) {
            $table->enum('status', ['aktif', 'tidak_aktif'])->default('aktif')->after('alamat');
            $table->text('prestasi')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('atlet', function (Blueprint $table) {
            $table->dropColumn(['status', 'prestasi']);
        });
    }
};
