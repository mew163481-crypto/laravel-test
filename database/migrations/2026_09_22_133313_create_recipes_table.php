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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('category_id')->nullable()->constrained('crafting-categories')->nullOnDelete();
            $table->foreignId('subgroup_id')->nullable()->constrained('subgroups')->nullOnDelete();
            $table->string('icon', 255);
            $table->string('ingredients',255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
