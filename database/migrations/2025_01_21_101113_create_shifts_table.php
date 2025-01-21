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
        Schema::create('shifts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->time('start_time')->nullable();
            $table->time('start_grace_time')->nullable();
            $table->time('end_time')->nullable();
            $table->time('end_grace_time')->nullable();
            $table->float('total_time')->nullable();
            $table->time('lunch_start')->nullable();
            $table->time('lunch_end')->nullable();

            $table->longText('description')->nullable();
            $table->integer('order')->nullable();
            $table->boolean('status')->default(1);
            $table->bigInteger('department_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shifts');
    }
};
