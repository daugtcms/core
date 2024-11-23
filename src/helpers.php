<?php

declare(strict_types=1);

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
