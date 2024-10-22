<?php

namespace Daugt\Jobs\Shop\StripeWebhooks;

use Daugt\Models\Shop\Order;

class InvoiceEvent extends StripeWebhookJob
{
    public function handle()
    {
        $payload = $this->webhookCall->payload;

        $order = Order::where('stripe_payment_intent_id', $payload['data']['object']['payment_intent'])->firstOrFail();

        $order->stripe_invoice_id = $payload['data']['object']['id'];
        $order->save();
    }
}
