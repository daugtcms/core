<?php

namespace Sitebrew\Injectable;

class StripeClient
{
    public static function init(): \Stripe\StripeClient
    {
        return new \Stripe\StripeClient([
            'api_key' => config('sitebrew.stripe.secret'),
            'stripe_version' => '2023-10-16',
        ]);
    }
}
