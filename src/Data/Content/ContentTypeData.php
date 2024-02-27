<?php

namespace Sitebrew\Data\Content;

use Illuminate\Support\Collection;
use Sitebrew\Data\Theme\AttributeData;
use Sitebrew\Enums\Content\ContentGroup;
use Spatie\LaravelData\Data;

class ContentTypeData extends Data
{
    public string $name;

    public ContentGroup $group;

    public bool $categorized;

    public bool $listable;

    /**
     * @var Collection<string, AttributeData>
     */
    public Collection $attributes;
}
