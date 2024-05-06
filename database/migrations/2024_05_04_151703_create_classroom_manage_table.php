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
        Schema::create('classroom_manage', function (Blueprint $table) {
            $table->id();
            $table->foreignId('roomID')->constrained('classroom','id');
            $table->foreignId('classID')->constrained('classes');
            $table->foreignId('shiftID')->constrained('class_study_shifts', 'id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classroom_manage');
    }
};
