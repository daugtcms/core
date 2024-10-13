<?php

namespace Daugt\Data\Listing;

use Illuminate\Support\Collection;
use Livewire\Wireable;
use Daugt\Data\Theme\AttributeData;
use Spatie\LaravelData\Concerns\WireableData;
use Spatie\LaravelData\Data;

class ListingTypeData extends Data implements Wireable
{
    use WireableData;

    public string $name;

    public string $description;

    /**
     * @var Collection<string, AttributeData>
     */
    public Collection $listAttributes;

    /**
     * @var Collection<string, AttributeData>
     */
    public Collection $itemAttributes;

    public bool $multi = false;
}
