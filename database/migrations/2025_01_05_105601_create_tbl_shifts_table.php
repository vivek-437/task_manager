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
        Schema::create('tbl_shifts', function (Blueprint $table) {
            $table->integer('id', 11)->autoIncrement();
            $table->enum('shift_type', ['morning', 'evening', 'night'])->nullable(); // Shift type (e.g., morning, evening, night)
            $table->timestamp('start_time'); // Shift start time
            $table->timestamp('end_time'); // Shift end time
            $table->string('location', 255)->nullable(); // Optional location of the shift
            $table->text('notes')->nullable(); // Optional notes about the shift
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_shifts');
    }
};
