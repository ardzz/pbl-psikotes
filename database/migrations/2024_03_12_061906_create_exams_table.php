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
            $table->foreignId("payment_id")->nullable();
            $table->boolean("approved")->default(false); // approved by admin
            $table->boolean("validated")->default(false); // validated the result by doctor
            $table->longText("note")->nullable(); // doctor's note written after the exam
            $table->longText("conclusion")->nullable(); // result of the exam
            $table->longText("signature")->nullable(); // result of the exam
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
