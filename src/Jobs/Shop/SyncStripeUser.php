<?php

namespace Daugt\Jobs\Shop;

use Daugt\Jobs\BaseJob;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Daugt\Injectable\StripeClient;
use Daugt\Models\User;

class SyncStripeUser extends BaseJob
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public User $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function handle()
    {
        $stripe = StripeClient::init();
        if (! $this->user->stripe_id) {
            $customer = $stripe->customers->create([
                'email' => $this->user->email,
                'preferred_locales' => ['de-DE'],
            ], StripeClient::getStripeOptions());
            $this->user->stripe_id = $customer->id;
            $this->user->saveQuietly();
        } else {
            $stripe->customers->update($this->user->stripe_id, [
                'email' => $this->user->email,
            ], StripeClient::getStripeOptions());
        }
    }
}
