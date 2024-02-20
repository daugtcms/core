<?php

namespace Sitebrew\Data\Blocks;

use Spatie\LaravelData\Data;

class BlockData extends Data
{
    public function __construct(
        public string $block = '',
        public string $uuid = '',
        public array $attributes = [],
    ) {
    }
}
