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
        Schema::create('excused_absences', function (Blueprint $table) {
            $table->id();
            $table->foreignId("studentID")->constrained("students","id");
            $table->string('numberOfAbsent');
            $table->foreignId('subjectID')->constrained('subjects','id');
            $table->timestamps();
        });

        Schema::create('unexcused_absences', function (Blueprint $table) {
            $table->id();
            $table->foreignId("studentID")->constrained("students","id");
            $table->string('numberOfLate');
            $table->foreignId('subjectID')->constrained('subjects','id');
            $table->timestamps();
        });

        Schema::create('onTime', function (Blueprint $table) {
            $table->id();
            $table->foreignId("studentID")->constrained("students","id");
            $table->string('numberOfOnTime');
            $table->foreignId('subjectID')->constrained('subjects','id');
            $table->timestamps();
        });


        Schema::create('late', function (Blueprint $table) {
            $table->id();
            $table->foreignId("studentID")->constrained("students","id");
            $table->string('numberOfOnTime');
            $table->foreignId('subjectID')->constrained('subjects','id');
            $table->timestamps();
        });

        Schema::create('attendance', function (Blueprint $table) {
            $table->id();
            $table->String("dateInWeek");
            $table->foreignId('schoolShiftID')->constrained('schoolShift','id');
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
        Schema::dropIfExists('excused_absences');
        Schema::dropIfExists('unexcused_absences');
        Schema::dropIfExists('onTime');
        Schema::dropIfExists('late');
        Schema::dropIfExists('attendance');
    }
};
