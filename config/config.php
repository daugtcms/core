<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    'available_blocks' => [
        'header' => \Felixbeer\SiteCore\Blocks\View\Blocks\Header::class,
    ],
    'available_templates' => [
        'floating-homepage' => \Felixbeer\SiteCore\Blocks\View\Blocks\Templates\FloatingHomepage::class,
    ],
];
