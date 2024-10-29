<?php

namespace Daugt\Injectable;

class StripeClient
{
    public static function init(): \Stripe\StripeClient
    {
        return new \Stripe\StripeClient([
            'api_key' => config('daugt.stripe.secret'),
            'stripe_version' => '2024-09-30.acacia',
        ]);
    }

    public static function getStripeOptions()
    {
        $options = [];
        $stripeAccountId = config('daugt.stripe.connect_account_id');

        if (!empty($stripeAccountId)) {
            $options['stripe_account'] = $stripeAccountId;
        }

        return $options;
    }
}
