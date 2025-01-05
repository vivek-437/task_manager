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
            $table->timestamp('start_time');
            $table->timestamp('end_time');
            $table->timestamp('duration');
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
