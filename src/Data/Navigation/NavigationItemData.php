<?php

namespace Sitebrew\Data\Navigation;

use Livewire\Wireable;
use Spatie\LaravelData\Concerns\WireableData;
use Spatie\LaravelData\Data;

class NavigationItemData extends Data implements Wireable
{
    use WireableData;

    public function __construct(
        public string $uuid = '',
        public int $order = 0,
        public string $name = '',
        public string $description = '',
        public string $url = '',
        public string $icon = '',
        public string $target = '_self',
    ) {
    }
}
