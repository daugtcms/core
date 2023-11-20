<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('templates', function (Blueprint $table) {
            $table->jsonb('available_blocks')->nullable();
        });
    }
};