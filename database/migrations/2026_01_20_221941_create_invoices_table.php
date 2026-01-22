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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('customer_id')->constrained('customers');
            $table->foreignId('appointment_id')->constrained('appointments');
            $table->string('invoice_number')->unique();
            $table->enum('status',['sent','draft','viewed','paid','overdue','cancelled']);
            $table->timestamp('issue_date');
            $table->timestamp('due_date')->nullable();
            $table->decimal('total_amount');
            $table->decimal('paid_amount');
            $table->text('notes');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
