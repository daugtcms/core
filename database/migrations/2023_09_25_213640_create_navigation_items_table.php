<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('navigation_items', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->json('name');
            $table->json('description')->nullable();
            $table->json('url')->nullable();
            $table->nullableMorphs('navigable');
            $table->string('icon')->nullable();
            $table->string('target')->default('_self');
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
};
