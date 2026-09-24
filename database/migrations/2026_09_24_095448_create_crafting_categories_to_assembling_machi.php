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
        Schema::create('crafting_categories_to_assembling_machines', function (Blueprint $table) {
            $table->foreignId('assembling_machine_id')->constrained('assembling_machines')->cascadeOnDelete();
            $table->foreignId('crafting_category_id')->constrained('crafting_categories')->cascadeOnDelete();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crafting_categories_to_assembling_machines');
    }
};
