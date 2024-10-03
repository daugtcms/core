<?php

namespace Daugt\Data\Theme;

use Illuminate\Support\Collection;
use Daugt\Enums\Content\ContentGroup;
use Livewire\Wireable;
use Spatie\LaravelData\Concerns\WireableData;
use Spatie\LaravelData\Data;

class ThemeBlockData extends Data implements Wireable
{
    use WireableData;

    public string $name;

    public string $description;

    public ?string $view;
    public ?string $viewPath;

    /** @var array<ContentGroup> */
    public array $groups;

    /** @var Collection<string, AttributeData> */
    public Collection $attributes;

    public function getView(): string {
        return $this->view ?? $this->view = file_get_contents($this->viewPath);
    }

}
