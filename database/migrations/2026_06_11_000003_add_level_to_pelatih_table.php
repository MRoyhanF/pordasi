<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pelatih', function (Blueprint $table) {
            $table->enum('level', ['pelopor', 'jelajah', 'sigap', 'utama', 'lainnya'])->nullable()->after('isActive');
        });
    }

    public function down(): void
    {
        Schema::table('pelatih', function (Blueprint $table) {
            $table->dropColumn('level');
        });
    }
};
