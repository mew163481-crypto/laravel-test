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
        Schema::create('assembling-machines', function (Blueprint $table) {
            $table->id();
            $table->string('name',150);
            $table->string('icon', 255);
            $table->string('subgroup',255);
            $table->integer('stack_size');
            $table->string('next_upgrade',100);
            $table->integer('crafting_speed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assembling-machines');
    }
};
