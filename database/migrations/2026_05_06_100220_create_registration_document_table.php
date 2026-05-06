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
        Schema::create('registration_document', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registrationId')->constrained('admin_registration')->onDelete('cascade');
            $table->integer('stepNumber')->nullable();
            $table->string('fileName')->nullable();
            $table->string('fileUrl')->nullable();
            $table->string('fileType')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registration_document');
    }
};
