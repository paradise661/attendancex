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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->date('date')->nullable();
            $table->string('type')->nullable();
            $table->time('checkin')->nullable();
            $table->time('checkout')->nullable();
            $table->time('break_start')->nullable();
            $table->time('break_end')->nullable();
            $table->float('total_break')->nullable();
            $table->float('worked_hours')->nullable();
            $table->float('overtime_minute')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('device')->nullable();
            $table->string('attendance_by')->nullable();
            $table->longText('request_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
