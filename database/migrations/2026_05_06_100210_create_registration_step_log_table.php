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
        Schema::create('registration_step_log', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registrationId')->constrained('admin_registration')->onDelete('cascade');
            $table->integer('stepNumber');
            $table->string('stepName')->nullable();
            $table->enum('status', ['Pending', 'Passed', 'Failed'])->nullable();
            $table->foreignId('reviewedBy')->nullable()->constrained('users')->onDelete('set null');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registration_step_log');
    }
};
