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
        Schema::create('personal_informations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('nik')->unique();
            $table->string('occupation')->nullable();
            $table->date('birthdate');
            $table->string('phone_number')->nullable();
            $table->string('religion')->nullable();
            $table->enum('marital_status', ['single', 'married', 'divorced', 'widowed'])->nullable();
            $table->enum('education', ['elementary', 'junior_high', 'senior_high', 'diploma', 'bachelor', 'master', 'doctor'])
                ->default('senior_high')->nullable();
            $table->enum('sex', ['m', 'f']); // there are only two genders lmao
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->string('district')->nullable();
            $table->string('sub_district')->nullable();
            $table->string('address')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_information');
    }
};
