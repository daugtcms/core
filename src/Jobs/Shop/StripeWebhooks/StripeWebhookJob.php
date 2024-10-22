<?php

namespace Daugt\Jobs\Shop\StripeWebhooks;

use Daugt\Jobs\BaseJob;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\WebhookClient\Models\WebhookCall;

class StripeWebhookJob extends BaseJob
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public WebhookCall $webhookCall;

    public function __construct(WebhookCall $webhookCall)
    {
        $this->webhookCall = $webhookCall;
        $accountId = $webhookCall->payload['account'];
        $this->initializeTenancy($accountId);
    }

    public function initializeTenancy($accountId = null)
    {
        if(empty($accountId)) return;

        if(function_exists('tenancy')) {
            $tenant = \App\Models\Tenant::where('stripe_connect_account_id', $accountId)->first();
            if($tenant) {
                tenancy()->initialize($tenant);
            }
        }
    }
}