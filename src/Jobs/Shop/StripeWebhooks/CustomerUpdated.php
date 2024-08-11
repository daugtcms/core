<?php

namespace Daugt\Jobs\Shop\StripeWebhooks;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Daugt\Models\User;
use Spatie\WebhookClient\Models\WebhookCall;

class CustomerUpdated implements ShouldQueue
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
        $user = User::where('stripe_id', $payload['data']['object']['id'])->firstOrFail();
        $user->address = [
            'shipping' => $payload['data']['object']['shipping'],
            'billing' => $payload['data']['object']['address'],
        ];
        $user->save();
    }
}
