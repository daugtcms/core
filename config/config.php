<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    'multitenancy' => false,
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
        'connect_account_id' => env('STRIPE_CONNECT_ACCOUNT_ID'),
        'default_tax_code' => env('STRIPE_DEFAULT_TAX_CODE'),
    ],
    'style' => [
        'font' => [
            'main' => env('STYLE_FONT_MAIN'),
            'accent' => env('STYLE_FONT_ACCENT'),
        ]
    ],
    'themes' => []
];
