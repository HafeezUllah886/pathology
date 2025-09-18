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
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->string('patient_name');
            $table->string('patient_age')->nullable();
            $table->string('patient_gender')->nullable();
            $table->string('patient_contact')->nullable();
            $table->string('refered_by')->nullable();
            $table->dateTime('entery_time')->nullable();
            $table->dateTime('reporting_time')->nullable();
            $table->foreignId('entered_by')->constrained('users')->cascadeOnDelete();
            $table->decimal('amount', 10, 2)->default(0);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('net_amount', 10, 2)->default(0);
            $table->text('cancel_reason')->nullable();
            $table->foreignId('paid_in')->constrained('accounts')->cascadeOnDelete();
            $table->enum('status', ['pending', 'completed', 'cancelled'])->default('pending');
            $table->bigInteger('refID');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipts');
    }
};
