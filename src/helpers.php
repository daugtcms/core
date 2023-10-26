<?php

declare(strict_types=1);

use Felixbeer\SiteCore\Navigation\Models\Navigation;

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

if (! function_exists('collection_compare')) {
    function collection_compare($firstCollection, $secondCollection)
    {
        if ($firstCollection->count() !== $secondCollection->count()) {
            return false;
        }

        $firstCollection = $firstCollection->toArray();
        $secondCollection = $secondCollection->toArray();

        foreach ($firstCollection as $key => $value) {
            if (! array_key_exists($key, $secondCollection)) {
                return false;
            }

            if (is_array($value)) {
                if (! collection_compare(collect($value), collect($secondCollection[$key]))) {
                    return false;
                }
            } elseif ($value !== $secondCollection[$key]) {
                return false;
            }
        }

        return true;
    }
}

if (! function_exists('get_navigation_items')) {
    function get_navigation_items($navigationId)
    {
        return Navigation::findOrFail($navigationId)->items;
    }
}
