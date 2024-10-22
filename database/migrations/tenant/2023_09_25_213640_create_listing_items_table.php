<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('listing_items', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->string('name');
            $table->string('slug');
            $table->string('description')->nullable();
            $table->string('icon')->nullable();
            $table->jsonb('data')->nullable();
            $table->nullableMorphs('navigable');
            $table->smallInteger('order')->default(0);
            $table->foreignId('listing_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('listing_items')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }
};
