<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    'available_blocks' => [
    ],
    'available_templates' => [
    ],
    'content_types' => [
        'post' => 'Beitrag',
        'page' => 'Seite',
        'blog' => 'Blog',
    ],
    'shop' => [
        'shipping' => [
            'locale' => env('SHOP_SHIPPING_LOCALE'),
            'code' => env('SHOP_SHIPPING_CODE'),
            'allowed_countries' => env('SHOP_SHIPPING_ALLOWED_COUNTRIES'),
        ],
    ],
    'stripe' => [
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
        'default_tax_code' => env('STRIPE_DEFAULT_TAX_CODE'),
    ],
];
