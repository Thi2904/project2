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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->String('subjectName');
            $table->String('codeName');
            $table->integer('subjectTime');
            $table->text('description')->nullable();
            $table->foreignId('majorID')->constrained('major','id');
            $table->foreignId('curriculumID')->constrained('curriculum','id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
