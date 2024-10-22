<?php

use Daugt\Enums\Shop\AccessType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('product_has_access', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')
                ->constrained()
                ->onDelete('cascade');
            $table->morphs('access');
            $table->enum('type', [AccessType::PERMANENT->value, AccessType::DURATION->value, AccessType::DATES->value])->default(AccessType::PERMANENT->value);
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->integer('duration')->nullable();
        });
    }
};
