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
        Schema::create('schoolShiftDetail', function (Blueprint $table) {
            $table->id();
            $table->String("dateInWeek");
            $table->foreignId('schoolShiftID')->constrained('schoolShift','id');
            $table->foreignId('classroomID')->constrained('classroom','id');
            $table->foreignId('shiftsID')->constrained('_shifts','id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schoolShiftDetail');
    }
};
