<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kuda', function (Blueprint $table) {
            $table->enum('keahlian', ['berkuda_memanah', 'jumping', 'dressage', 'polo'])->nullable()->after('pemilik');
        });
    }

    public function down(): void
    {
        Schema::table('kuda', function (Blueprint $table) {
            $table->dropColumn('keahlian');
        });
    }
};
