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
        Schema::create('tbl_attendances', function (Blueprint $table) {
            $table->integer('id', 11)->autoIncrement();
            $table->time('in_time')->nullable();
            $table->time('out_time')->nullable();
            $table->string('duration');
            $table->integer('tbl_shift_id');
            $table->integer('tbl_user_id');
            $table->boolean('over_time')->nullable()->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_attendances');
    }
};
