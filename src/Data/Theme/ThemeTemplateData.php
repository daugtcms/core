<?php

namespace Daugt\Data\Theme;

use Illuminate\Support\Collection;
use Daugt\Enums\Content\ContentGroup;
use Spatie\LaravelData\Data;

class ThemeTemplateData extends ThemeBlockData
{
    /** @var array<string> */
    public array $usages;
}
