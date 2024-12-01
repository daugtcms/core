<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->morphs('commentable');

            $table->foreignId('parent_id')->nullable()->constrained('comments')->onDelete('cascade');

            $table->jsonb('text')->nullable();

            $table->timestamps();
        });
    }
};
