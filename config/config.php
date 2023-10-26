<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    'available_blocks' => [
        'header' => \Sitebrew\Blocks\View\Blocks\Header::class,
    ],
    'available_templates' => [
        'floating-homepage' => \Sitebrew\Blocks\View\Blocks\Templates\FloatingHomepage::class,
    ],
];
