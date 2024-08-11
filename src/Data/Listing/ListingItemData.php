<?php

namespace Daugt\Data\Listing;

use Livewire\Wireable;
use Spatie\LaravelData\Concerns\WireableData;
use Spatie\LaravelData\Data;

class ListingItemData extends Data implements Wireable
{
    use WireableData;

    public function __construct(
        public string $uuid = '',
        public int $order = 0,
        public string $name = '',
        public string $description = '',
        public array $data = [],
    ) {
    }
}
