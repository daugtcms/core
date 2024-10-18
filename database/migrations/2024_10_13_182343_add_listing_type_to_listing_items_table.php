<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('listing_items', function (Blueprint $table) {
            $table->string('listing_type')->nullable();
        });

        DB::statement('
            UPDATE listing_items
            SET listing_type = listings.type
            FROM listings
            WHERE listings.id = listing_items.listing_id;
        ');
    }
};
