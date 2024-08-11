<?php

namespace Daugt\Controllers\Shop;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Daugt\Controllers\Controller;
use Daugt\Injectable\StripeClient;
use Daugt\Models\Shop\Product;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        $within_country = $request->exists('within_country');

        $cart = collect(request()->session()->get('cart', []));

        $products = Product::whereIn('id', $cart->keys())->get();

        if ($products->isNotEmpty()) {
            $itemArray = [];

            $isSubscription = false;
            $isShipping = false;
            foreach ($products as $product) {
                $itemArray[] = [
                    'price' => $product->stripe_price_id,
                    'quantity' => $cart->get($product->id),
                ];
                if ($product->billing_type === 'subscription') {
                    $isSubscription = true;
                }
                if ($product->shipping) {
                    $isShipping = true;
                }
            }
            if (Auth::check()) {
                $stripe = StripeClient::init();

                $payload = [
                    'success_url' => route('member-area.orders.index').'?success',
                    'cancel_url' => url()->previous(),
                    'line_items' => $itemArray,
                    'mode' => $isSubscription ? 'subscription' : 'payment',
                    'customer' => Auth::user()->stripe_id,
                    'customer_update' => [
                        'shipping' => 'auto',
                        'address' => 'auto',
                    ],
                    'automatic_tax' => [
                        // automatic
                        'enabled' => true,
                    ],
                    'invoice_creation' => [
                        'enabled' => true
                    ],
                    'billing_address_collection' => 'required',
                    'allow_promotion_codes' => true,
                ];
                if ($isShipping) {
                    $country = \Locale::getDisplayRegion(config('daugt.shop.shipping.locale'), config('daugt.shop.shipping.locale'));
                    if ($within_country) {
                        $payload[] = [
                            'shipping_address_collection' => ['allowed_countries' => [config('daugt.shop.shipping.code')]],
                            'shipping_options' => [
                                [
                                    'shipping_rate_data' => [
                                        'display_name' => "nach $country",
                                        'type' => 'fixed_amount',
                                        'fixed_amount' => [
                                            'amount' => 500,
                                            'currency' => 'eur',
                                        ],
                                        'tax_behavior' => 'inclusive',
                                    ],
                                ],
                            ],
                        ];
                    } else {
                        // convert comma separated string to array
                        $allowed_countries = collect(explode(',', config('daugt.shop.shipping.allowed_countries')))->map(function ($country) {
                            return $country;
                        });

                        $allowed_countries = $allowed_countries->filter(function ($country) {
                            return $country !== config('daugt.shop.shipping.code');
                        })->values()->toArray();

                        $payload[] = [
                            'shipping_address_collection' => ['allowed_countries' => $allowed_countries],
                            'shipping_options' => [
                                [
                                    'shipping_rate_data' => [
                                        'display_name' => "außerhalb $country",
                                        'type' => 'fixed_amount',
                                        'fixed_amount' => [
                                            'amount' => 1000,
                                            'currency' => 'eur',
                                        ],
                                        'tax_behavior' => 'inclusive',
                                    ],
                                ],
                            ],
                        ];
                    }
                }
                return redirect(
                    $stripe->checkout->sessions->create($payload)->url
                );
            } else {
                app('redirect')->setIntendedUrl(route('checkout'));

                return redirect()->route('login');
            }
        } else {
            return redirect()->back();
        }
    }

    public function billing()
    {
        $stripe = StripeClient::init();

        return redirect(
            $stripe->billingPortal->sessions->create([
                'customer' => Auth::user()->stripe_id,
                'return_url' => url()->previous(),
            ])->url
        );
    }
}
