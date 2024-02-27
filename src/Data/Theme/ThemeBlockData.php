<?php

namespace Sitebrew\Data\Theme;

use Illuminate\Support\Collection;
use Sitebrew\Enums\Content\ContentGroup;
use Spatie\LaravelData\Data;

class ThemeBlockData extends Data
{
    public string $name;

    public string $description;

    public string $viewName;

    /** @var array<ContentGroup> */
    public array $groups;

    /** @var Collection<string, AttributeData> */
    public Collection $attributes;
}
