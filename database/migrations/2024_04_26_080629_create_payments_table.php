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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->enum('method', ['manual', 'online'])->default('manual');
            $table->string('provider_payment_method')->nullable();
            $table->enum('status', ['pending', 'paid', 'failed'])->default('pending');
            $table->string('description')->default('Payment is pending');
            $table->string('bank_name')->nullable(); // if method is manual
            $table->string('bank_account')->nullable(); // if method is manual
            $table->string('bank_account_name')->nullable(); // if method is manual
            $table->integer('amount')->default(400000);
            $table->string('proof')->nullable(); // if method is manual
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
