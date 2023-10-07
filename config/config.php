<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    'available_blocks' => [
        'header' => \Felixbeer\SiteCore\Blocks\View\Blocks\Header::class,
    ],
    'available_templates' => [
        'homepage' => \Felixbeer\SiteCore\Blocks\View\Templates\Homepage::class,
        'homepage1' => \Felixbeer\SiteCore\Blocks\View\Blocks\Header::class,
    ],
];
