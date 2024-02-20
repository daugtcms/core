<?php

use Sitebrew\Jobs\Shop\StripeWebhooks\CheckoutSessionCompleted;
use Sitebrew\Jobs\Shop\StripeWebhooks\CustomerUpdated;
use Sitebrew\Jobs\Shop\StripeWebhooks\InvoiceEvent;

return [
    /*
     * Stripe will sign each webhook using a secret. You can find the used secret at the
     * webhook configuration settings: https://dashboard.stripe.com/account/webhooks.
     */
    'signing_secret' => env('STRIPE_WEBHOOK_SECRET'),

    /*
     * You can define the job that should be run when a certain webhook hits your application
     * here. The key is the name of the Stripe event type with the `.` replaced by a `_`.
     *
     * You can find a list of Stripe webhook types here:
     * https://stripe.com/docs/api#event_types.
     */
    'jobs' => [
        'customer_updated' => CustomerUpdated::class,
        'checkout_session_completed' => CheckoutSessionCompleted::class,
        'checkout_session_async_payment_succeeded' => CheckoutSessionCompleted::class,
        'checkout_session_async_payment_failed' => CheckoutSessionCompleted::class,
        'invoice_paid' => InvoiceEvent::class,
    ],

    /*
     * The classname of the model to be used. The class should equal or extend
     * Spatie\WebhookClient\Models\WebhookCall.
     */
    'model' => \Spatie\WebhookClient\Models\WebhookCall::class,

    /**
     * This class determines if the webhook call should be stored and processed.
     */
    'profile' => \Spatie\WebhookClient\WebhookProfile\ProcessEverythingWebhookProfile::class,

    /*
     * When disabled, the package will not verify if the signature is valid.
     * This can be handy in local environments.
     */
    'verify_signature' => env('STRIPE_SIGNATURE_VERIFY', true),
];