<?php

namespace Daugt\Data\Content;

use Illuminate\Support\Collection;
use Daugt\Data\Theme\AttributeData;
use Daugt\Enums\Content\ContentGroup;
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
