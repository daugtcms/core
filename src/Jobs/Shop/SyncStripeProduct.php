<?php

namespace Daugt\Jobs\Shop;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Daugt\Injectable\StripeClient;
use Daugt\Models\Shop\Product;

class SyncStripeProduct implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Product $product;

    public function __construct($product)
    {
        $this->product = $product;
    }

    public function handle()
    {
        $stripe = StripeClient::init();

        // If there is already an existing product and price, update it
        if ($this->product->stripe_product_id && $this->product->stripe_price_id) {
            $stripe->products->update($this->product->stripe_product_id, [
                'name' => $this->product->name,
                'tax_code' => $this->product->stripe_tax_code_id ?? config('daugt.stripe.default_tax_code'),
            ]);

            if ($this->product->id) {
                $price = $stripe->prices->retrieve($this->product->stripe_price_id)->unit_amount;
                // If anything pricewise changed, we need to disable the old price and create a new one
                if (/*$dbProduct->billing_type !== $this->product->billing_type || $dbProduct->interval !== $this->product->interval ||*/floatval($price / 100) !== floatval($this->product->price)) {
                    $stripe->prices->update($this->product->stripe_price_id, ['active' => false]);
                    $price_array = [
                        'unit_amount' => intval($this->product->price * 100),
                        'product' => $this->product->stripe_product_id,
                        'currency' => 'eur',
                        'tax_behavior' => 'inclusive',
                    ];
                    // TODO: Add subscription support
                    /*if ($this->product->type === 'subscription') {
                        array_push($price_array, ['recurring' => ['interval' => ($this->product->interval === '3month' ? 'month' : $this->product->interval), 'interval_count' => ($this->product->interval === '3month' ? 3 : 1)]]);
                    }*/
                    $this->product->stripe_price_id = $stripe->prices->create($price_array)->id;
                }
            }
        } else {
            $stripe_product_id = $stripe->products->create([
                'name' => $this->product->name,
                'tax_code' => $this->product->stripe_tax_code_id ?? config('daugt.stripe.default_tax_code'),
            ])->id;
            $price_array = [
                'unit_amount' => intval($this->product->price * 100),
                'product' => $stripe_product_id,
                'currency' => 'eur',
                'tax_behavior' => 'inclusive',
            ];
            // TODO: Add subscription support
            /*if ($this->type === 'subscription') {
                array_push($price_array, ['recurring' => ['interval' => ($this->interval === '3month' ? 'month' : $this->interval), 'interval_count' => ($this->interval === '3month' ? 3 : 1)]]);
            }*/
            $this->product->stripe_product_id = $stripe_product_id;
            $this->product->stripe_price_id = $stripe->prices->create($price_array)->id;
        }

        $this->product->saveQuietly();
    }
}
