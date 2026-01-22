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
        Schema::create('monthly_metrics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->date('month')->index();
            $table->integer('year');
            $table->decimal('revenue', 9,2);
            $table->integer('appointments_scheduled');
            $table->integer('appointments_completed');
            $table->integer('new_customers')->default(0);
            $table->integer('repeat_customers')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthly_metrics');
    }
};
