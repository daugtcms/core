<?php

namespace Sitebrew\Data\Theme;

use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

class ThemeData extends Data
{
    public string $name;

    /**
     * @var Collection<string, ThemeBlockData>
     */
    public Collection $blocks;

    /**
     * @var Collection<string, ThemeBlockData>
     */
    public Collection $templates;
}
