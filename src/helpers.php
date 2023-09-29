<?php

declare(strict_types=1);

if (! function_exists('svg')) {
    function svg(string $path, $class = '', array $attributes = []): string
    {
        $path = trim($path, "' ");
        $class = trim($class, "' ");
        $svg = new \DOMDocument();
        try {
            $svg->load(storage_path('app/public/icons/default/'.$path.'.svg'));
        } catch (\Exception $e) {
            return '';
        }
        $svg->documentElement->setAttribute('class', $class);

        foreach ($attributes as $key => $value) {
            $svg->documentElement->setAttribute($key, $value);
        }

        return $svg->saveXML($svg->documentElement);
    }
}
