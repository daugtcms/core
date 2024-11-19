<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('analytics_events', function (Blueprint $table) {
            $table->uuid();
            $table->string('session_id');
            $table->string('event')->nullable();
            $table->nullableMorphs('eventable');
            $table->json('data')->nullable();
            $table->timestamp('created_at');
            $table->integer('aggregated_amount')->nullable();
        });
    }
};
