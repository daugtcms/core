<?php

namespace Daugt\Jobs\Shop\StripeWebhooks;

use Daugt\Jobs\BaseJob;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Daugt\Models\Shop\Order;
use Spatie\WebhookClient\Models\WebhookCall;

class InvoiceEvent extends BaseJob
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
