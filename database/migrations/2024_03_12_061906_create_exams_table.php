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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id");
            $table->string("purpose")->default("General Checkup");
            $table->timestamp("start_time")->nullable();
            $table->timestamp("end_time")->nullable();
            $table->foreignId("doctor_id")->nullable();
            $table->boolean("approved")->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
