<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('stripe_tax_codes', function (Blueprint $table) {
            $table->string("id")->primary();
            $table->text("description");
            $table->string("name");
        });
    }
};
