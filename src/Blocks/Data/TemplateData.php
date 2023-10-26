<?php

namespace Sitebrew\Blocks\Data;

use Spatie\LaravelData\Data;

class TemplateData extends Data
{
    public function __construct(
        public string $template = '',
        public array $attributes = [],
    ) {
    }
}
