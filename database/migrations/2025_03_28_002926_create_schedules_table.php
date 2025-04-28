<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('section_id');
            $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('year_id');
            $table->string('day');
            $table->time('start_at');
            $table->time('end_at');
            $table->boolean('status')->default(1);
            $table->timestamps();

            // Ensure no exact duplicate schedule exists
            $table->unique(['section_id', 'teacher_id', 'subject_id', 'year_id', 'day', 'start_at', 'end_at'], 'unique_schedule');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
};
