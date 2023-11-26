<?php

namespace Sitebrew\Jobs\Shop\StripeWebhooks;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Sitebrew\Models\Shop\Order;
use Spatie\WebhookClient\Models\WebhookCall;

class InvoiceEvent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var WebhookCall */
    public $webhookCall;

    public function __construct(WebhookCall $webhookCall)
    {
        $this->webhookCall = $webhookCall;
    }

    public function handle()
    {
        $payload = $this->webhookCall->payload;

        $order = Order::where('stripe_payment_intent_id', $payload['data']['object']['payment_intent'])->firstOrFail();

        $order->stripe_invoice_id = $payload['data']['object']['id'];
        $order->save();
    }
}
