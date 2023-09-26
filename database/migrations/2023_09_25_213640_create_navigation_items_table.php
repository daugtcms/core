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
        Schema::create('navigation_items', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->json('description')->nullable();
            $table->string('url')->nullable();
            $table->nullableMorphs('navigable');
            $table->string('icon')->nullable();
            $table->boolean('in_new_tab')->default(false);
            $table->smallInteger('order')->default(0);
            $table->foreignId('navigation_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('navigation_items')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('navigation_items');
    }
};
