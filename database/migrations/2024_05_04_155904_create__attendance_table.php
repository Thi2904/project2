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
        Schema::create('attendance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('schoolShiftID')->constrained('schoolShift','id');
            $table->time('time_in');
            $table->time('time_out');
            $table->date('date');
            $table->timestamps();
        });

        Schema::create('student_attend_manage', function (Blueprint $table) {
            $table->id();
            $table->foreignId('studentID')->constrained('students','id');
            $table->foreignId('subjectID')->constrained('subjects','id');
            $table->integer('di_hoc')->default(0);
            $table->integer('nghi_co_phep')->default(0);
            $table->integer('nghi_khong_phep')->default(0);
            $table->integer('tre')->default(0);
            $table->timestamps();
        });

        Schema::create('attend_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attendID')->constrained('attendance','id');
            $table->foreignId('studentID')->constrained('students','id');
            $table->enum('status', ['đi học', 'nghỉ có phép', 'nghỉ không phép', 'trễ'])->default('đi học');
            $table->text('reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance');
    }
};
