<?php

namespace Sitebrew\Data\Theme;

use Sitebrew\Enums\Blocks\AttributeType;
use Spatie\LaravelData\Data;

class AttributeData extends Data
{
    public string $name;

    public string $description;

    public array $options;
    
    public AttributeType $type;
}
