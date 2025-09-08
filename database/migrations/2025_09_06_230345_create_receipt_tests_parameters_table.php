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
        Schema::create('receipt_tests_parameters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('receipt_test_id')->constrained('receipt_tests')->cascadeOnDelete();
            $table->string('value')->nullable();
            $table->enum('is_heading', ['yes', 'no'])->default('no');
            $table->string('unit')->nullable();
            $table->text('normal_range')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipt_tests_parameters');
    }
};
