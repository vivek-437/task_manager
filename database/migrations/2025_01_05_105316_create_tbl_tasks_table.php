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
        Schema::create('tbl_tasks', function (Blueprint $table) {
            $table->integer('id', 11)->autoIncrement();
            $table->string('title');
            $table->text('description');
            $table->enum('priority', ['low', 'medium', 'high']);
            $table->enum('status', ['to-do', 'in-progress', 'completed']);
            $table->integer('tbl_project_id');
            $table->timestamp('due_date');
            $table->integer('parent_task_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_tasks');
    }
};
