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
        Schema::create('attendance_requests', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->date('date')->nullable();
            $table->time('checkin')->nullable();
            $table->time('checkout')->nullable();
            $table->longText('reason')->nullable();
            $table->longText('action_reason')->nullable();
            $table->bigInteger('action_by')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_requests');
    }
};
