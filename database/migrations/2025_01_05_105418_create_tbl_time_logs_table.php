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
        Schema::create('tbl_time_logs', function (Blueprint $table) {
            $table->integer('id', 11)->autoIncrement();
            $table->integer('tbl_user_id');
            $table->integer('tbl_project_id');
            $table->integer('tbl_task_id');
            $table->timestamp('start_time')->nullable();
            $table->timestamp('end_time')->nullable();
            $table->string('duration')->nullable();
            $table->integer('tbl_shift_id');
            $table->timestamps();   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_time_logs');
    }
};
