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
        Schema::create('schoolShift', function (Blueprint $table) {
            $table->id();
            $table->String("dateStart");
            $table->foreignId('subjectID')->constrained('subjects','id');
            $table->foreignId('classID')->constrained('classes','id');
            $table->foreignId('teacherID')->constrained('teachers','id');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_class_study_shift');
    }
};
