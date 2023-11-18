<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('course_sections', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->foreignId('course_id')
                ->constrained()
                ->onDelete('cascade');
            $table->boolean('users_can_comment')->default(true);
            $table->boolean('users_can_post')->default(false);
            $table->boolean('users_can_post_anonymously')->default(false);
            $table->timestamps();
        });
    }
};
