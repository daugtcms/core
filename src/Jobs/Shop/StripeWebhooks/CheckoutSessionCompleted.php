<?php

namespace Sitebrew\Jobs\Shop\StripeWebhooks;

use Carbon\Carbon;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Sitebrew\Enums\Shop\PaymentStatus;
use Sitebrew\Enums\Shop\ShippingStatus;
use Sitebrew\Injectable\StripeClient;
use Sitebrew\Models\Shop\Order;
use Sitebrew\Models\Shop\OrderItem;
use Sitebrew\Models\Shop\Product;
use Sitebrew\Models\User;
use Spatie\WebhookClient\Models\WebhookCall;
use Stripe\Exception\ApiErrorException;

class CheckoutSessionCompleted implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public WebhookCall $webhookCall;

    public function __construct(WebhookCall $webhookCall)
    {
        $this->webhookCall = $webhookCall;
    }

    /**
     * @throws ApiErrorException
     * @throws Exception
     */
    public function handle()
    {
        $payload = $this->webhookCall->payload;

        $user = User::where('stripe_id', $payload['data']['object']['customer'])->firstOrFail();

        $checkout_session = $payload['data']['object']['id'];

        $stripe = StripeClient::init();

        $line_items = $stripe->checkout->sessions->allLineItems(
            $payload['data']['object']['id'],
            ['limit' => 100]
        )['data'];

        $status = $payload['data']['object']['payment_status'] == PaymentStatus::PAID->value ? PaymentStatus::PAID->value : ($payload['type'] === 'checkout.session.async_payment_failed' ? PaymentStatus::FAILED->value : PaymentStatus::PENDING->value);
        $order = Order::updateOrCreate(
            ['stripe_checkout_session_id' => $checkout_session, 'user_id' => $user->id],
            [
                'status' => $status,
                'stripe_payment_intent_id' => $payload['data']['object']['payment_intent'],
            ]
        );

        foreach ($line_items as $item) {
            // only parse one-time payments
            if (! $item['price']['recurring']) {
                $product = Product::where('stripe_product_id', $item['price']['product'])->where('billing_type', 'one_time')->firstOrFail();

                $shippingStatus = null;
                // this snippet is used, so the shippingStatus is not reset to pending when payment is completed
                $orderItem = OrderItem::where('order_id', $order->id)->where('product_id', $product->id)->where('user_id', $user->id)->first();
                if(!$orderItem) {
                    $shippingStatus = ShippingStatus::PENDING->value;
                } else {
                    $shippingStatus = $orderItem->shipping_status;
                }

                OrderItem::updateOrCreate(
                    ['order_id' => $order->id, 'product_id' => $product->id, 'user_id' => $user->id],
                    [
                        'quantity' => $item['quantity'],
                        'shipping_status' => $shippingStatus,
                        'starts_at' => $product->starts_at,
                        'ends_at' => $product->ends_at,
                    ]
                );

                // parse products that unlock community or academy
                /*if ($product->unlock) {
                    $ends_at = '';
                    $starts_at = '';
                    if ($product->interval === 'custom' && $product->starts_at && $product->ends_at) {
                        $starts_at = $product->starts_at;
                        $ends_at = $product->ends_at;
                    } else {
                        if ($product->unlock === 'community') {
                            $starts_at = Carbon::now();
                        } elseif ($product->unlock === 'academy' || $product->unlock === 'trainer') {
                            $starts_at = Carbon::create($product->year)->startOfYear();
                        }
                        switch ($product->interval) {
                            case 'week':
                                $ends_at = $starts_at->copy()->addWeek();
                                break;
                            case 'month':
                                $ends_at = $starts_at->copy()->addMonth();
                                break;
                            case '3month':
                                $ends_at = $starts_at->copy()->addMonths(3);
                                break;
                            case 'year':
                                $ends_at = $starts_at->copy()->addYear();
                        }
                    }

                    Subscription::updateOrCreate(
                        ['order_id' => $order->id, 'product_id' => $product->id, 'user_id' => $user->id],
                        [
                            'starts_at' => $starts_at,
                            'ends_at' => $ends_at,
                            'status' => $status,
                            'unit_price' => $item['price']['unit_amount'],
                        ]
                    );
                } else {*/
                // parse products that don't unlock anything
            } else {
                /*$product = Product::where('stripe_product_id', $item['price']['product'])->where('type', 'subscription')->firstOrFail();
                $subscription = $stripe->subscriptions->retrieve($payload['data']['object']['subscription']);

                $ends_at = $subscription->ended_at
                    ? Carbon::createFromTimestamp($subscription->ended_at)
                    : ($subscription->cancel_at ? Carbon::createFromTimestamp($subscription->cancel_at) : null);

                if (! $ends_at && ($product->unlock === 'academy' || $product->unlock === 'trainer')) {
                    $dt = Carbon::create($product->year);
                    if ($product->unlock === 'trainer') {
                        $ends_at = $dt->endOfYear();
                    } else {
                        $ends_at = Carbon::now()->addYear(1)->subHour(1);
                    }

                    $stripe = StripeClient::init();
                    $stripe->subscriptions->update(
                        $payload['data']['object']['subscription'],
                        ['cancel_at' => $ends_at->timestamp, 'proration_behavior' => 'none']
                    );
                }

                if ($product->unlock === 'academy') {
                    $ends_at = $product->ends_at;
                }

                Subscription::updateOrCreate(
                    ['order_id' => $order->id, 'product_id' => $product->id, 'user_id' => $user->id, 'stripe_subscription_id' => $payload['data']['object']['subscription']],
                    [
                        'status' => $status,
                        'starts_at' => Carbon::createFromTimestamp($subscription->start_date),
                        'ends_at' => $ends_at,
                        'unit_price' => $item['price']['unit_amount'],
                    ]
                );*/
            }
        }

        /*if ($status === 'paid') {
            $invoice = InvoiceHelper::create($order->id);
            $user->notify(new InvoicePaid($order, $invoice));
            CreateCouponJob::dispatch($line_items, $user);
        } elseif ($status === 'failed') {
            $user->notify(new InvoiceFailed($order));
            // $payload['data']['object']['url'];
        }*/
    }
}
