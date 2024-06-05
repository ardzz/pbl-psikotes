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
            $table->boolean("approved")->default(false);
            $table->boolean("validated")->default(false);
            $table->longText("note")->nullable();

            $table->longText("response_to_test")->nullable();
            $table->integer("validity_score")->nullable();

            $table->integer("work_performance")->nullable();
            $table->integer("adaptability")->nullable();
            $table->integer("psychological_issue")->nullable();
            $table->integer("destructive_action")->nullable();
            $table->integer("moral_integrity")->nullable();

            $table->longText("clinical_profile")->nullable();

            $table->longText("openness")->nullable();
            $table->longText("conscientiousness")->nullable();
            $table->longText("extraversion")->nullable();
            $table->longText("agreeableness")->nullable();
            $table->longText("neuroticism")->nullable();

            $table->longText("conclusion")->nullable();
            $table->longText("signature")->nullable();
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
