<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('marks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->morphs('markable');

            $table->string('type')->nullable();

            $table->unique(['user_id', 'markable_id', 'markable_type', 'type']);

            $table->timestamps();
        });
    }
};
