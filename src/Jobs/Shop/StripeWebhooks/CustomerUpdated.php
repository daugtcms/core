<?php

namespace Daugt\Jobs\Shop\StripeWebhooks;

use Daugt\Models\User;

class CustomerUpdated extends StripeWebhookJob
{
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
