<?php

namespace Felixbeer\SiteCore\Blocks\Data;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class BlockEditorData extends Data
{
    public function __construct(
        public TemplateData $template,
        #[DataCollectionOf(BlockData::class)]
        public DataCollection $blocks
    ) {
    }
}
