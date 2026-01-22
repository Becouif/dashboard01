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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('customer_id')->constrained('customers');
            $table->foreignId('services_id')->constrained('services');
            $table->string('title');
            $table->text('description');
            $table->enum('status', ['scheduled','confirmed','in_progress','completed','cancelled','no_show']);
            $table->date('appointment_date');
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->integer('duration_minutes')->default(00);
            $table->decimal('price');
            $table->decimal('paid_amount');
            $table->enum('payment_status',['pending','partial', 'paid','overdue']);
            $table->text('notes');
            $table->boolean('reminder_sent')->nullable();
            $table->text('cancellation_reason')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
