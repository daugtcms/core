<?php

use Daugt\Enums\Shop\BillingDurationUnit;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('product_has_access', function (Blueprint $table) {
            $table->enum('duration_unit', [BillingDurationUnit::HOUR->value, BillingDurationUnit::DAY->value, BillingDurationUnit::WEEK->value, BillingDurationUnit::MONTH->value, BillingDurationUnit::YEAR->value])->nullable();
        });
    }
};
