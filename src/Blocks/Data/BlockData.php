<?php

namespace Sitebrew\Blocks\Data;

use Spatie\LaravelData\Data;

class BlockData extends Data
{
    public function __construct(
        public string $block = '',
        public array $attributes = [],
    ) {
    }
}
