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
        Schema::create('absentManage', function (Blueprint $table) {
            $table->id();
            $table->foreignId("studentID")->constrained("students","id");
            $table->string('numberOfAbsent');
            $table->foreignId('subjectID')->constrained('subjects','id');
            $table->timestamps();
        });

        Schema::create('lateManage', function (Blueprint $table) {
            $table->id();
            $table->foreignId("studentID")->constrained("students","id");
            $table->string('numberOfLate');
            $table->foreignId('subjectID')->constrained('subjects','id');
            $table->timestamps();
        });

        Schema::create('onTimeManage', function (Blueprint $table) {
            $table->id();
            $table->foreignId("studentID")->constrained("students","id");
            $table->string('numberOfOnTime');
            $table->foreignId('subjectID')->constrained('subjects','id');
            $table->timestamps();
        });

        Schema::create('_roll_call', function (Blueprint $table) {
            $table->id();
            $table->foreignId("studentID")->constrained("students","id");
            $table->foreignId("absentID")->constrained("absentManage","id");
            $table->foreignId("lateID")->constrained("lateManage","id");
            $table->foreignId("beOnTimeID")->constrained("onTimeManage","id");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absentManage');
        Schema::dropIfExists('lateManage');
        Schema::dropIfExists('onTimeManage');
        Schema::dropIfExists('_roll_call');
    }
};
