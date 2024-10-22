<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('stripe_tax_code_id')->nullable()->after('stripe_price_id');
            $table->foreign('stripe_tax_code_id')->references('id')->on('stripe_tax_codes');
        });
    }
};
