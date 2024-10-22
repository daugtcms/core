<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('model_has_listing_items', function (Blueprint $table) {
            $table->foreignId('listing_item_id')
                ->constrained()
                ->onDelete('cascade');
            $table->morphs('model');
            $table->primary(['listing_item_id', 'model_id', 'model_type'], 'model_has_listing_items_id_model_type_primary');
        });
    }
};
