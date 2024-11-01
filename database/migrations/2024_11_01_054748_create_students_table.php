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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable();
            $table->string('name')->nullable();
            $table->string('gender')->nullable();
            $table->string('phone')->nullable();
            $table->string('university')->nullable();
            $table->string('major')->nullable();
            $table->text('gpa')->nullable();
            $table->string('year_of_graduation')->nullable();
            $table->string('domicile')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
