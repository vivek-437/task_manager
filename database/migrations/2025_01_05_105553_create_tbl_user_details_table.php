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
        Schema::create('tbl_user_details', function (Blueprint $table) {
            $table->integer('id', 11)->autoIncrement();
            $table->integer('tbl_user_id');
            $table->string('address', 255)->nullable(); 
            $table->string('phone', 15)->nullable(); 
            $table->date('date_of_birth')->nullable(); 
            $table->enum('gender', ['male', 'female', 'other'])->nullable(); 
            $table->string('profile_image_path')->nullable(); 
            $table->text('bio')->nullable();
            $table->string('nationality', 50)->nullable();
            $table->string('occupation', 100)->nullable(); 
            $table->string('resume_path')->nullable(); 
            $table->integer('tbl_shift_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_user_details');
    }
};
