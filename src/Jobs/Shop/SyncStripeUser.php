<?php

namespace Sitebrew\Jobs\Shop;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Sitebrew\Injectable\StripeClient;
use Sitebrew\Models\User;

class SyncStripeUser implements ShouldQueue
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
                'name' => $this->user->full_name,
                'email' => $this->user->email,
                'preferred_locales' => ['de-DE'],
            ]);
            $this->user->stripe_id = $customer->id;
            $this->user->saveQuietly();
        } else {
            $stripe->customers->update($this->user->stripe_id, [
                'name' => $this->user->full_name,
                'email' => $this->user->email,
            ]);
        }
    }
}