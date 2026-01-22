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
        Schema::create('customer_communication_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('customer_id')->constrained('customers');
            $table->enum('type',['call', 'email', 'sms', 'note']);
            $table->enum('direction', ['outgoing', 'incoming']);
            $table->string('subject');
            $table->text('content');
            $table->enum('status', ['sent', 'delivered','read', 'failed']);
            $table->timestamp('scheduled_for');
            $table->timestamp('sent_at')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_communication_logs');
    }
};
