<?php

namespace Daugt\Data\Blocks;

use Livewire\Wireable;
use Spatie\LaravelData\Concerns\WireableData;
use Spatie\LaravelData\Data;

class BlockData extends Data implements Wireable
{
    use WireableData;
    public function __construct(
        public string $block = '',
        public string $uuid = '',
        public array $attributes = [],
        public $coordinates = null,
    ) {
    }
}
