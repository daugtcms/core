<?php

namespace Daugt\Data\Analytics;

use Livewire\Wireable;
use Spatie\LaravelData\Concerns\WireableData;
use Spatie\LaravelData\Data;

class ViewsListItem extends Data implements Wireable
{
    use WireableData;
    public function __construct(
        public object $eventable,
        public int $views = 0,
        public float $percentage = 0,
    ) {
    }
}
