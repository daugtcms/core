<?php

namespace Sitebrew\View\Blocks;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use Nette\NotImplementedException;
use Sitebrew\View\ThemeRegistry;

class Block extends Component
{
    public string $uuid;

    public string $name;

    public $attributes = [];

    public static function getMetadata(): array
    {
        throw new NotImplementedException();
    }

    public function getAttributeValues(): array
    {
        throw new NotImplementedException();
    }

    public function __construct(string $name = null)
    {
        $this->uuid = Str::uuid();
        if (isset($name)) {
            $this->name = $name;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        dump($this->attributes);
        // get_called_class():: is necessary as self:: returns the Block class instead of the actual child class
        return view(ThemeRegistry::getThemeBlock($this->name)['viewName'], $this->attributes);
    }

    public function getView(): string
    {
        return ThemeRegistry::getThemeBlock($this->name)['viewName'] ?? ThemeRegistry::getThemeTemplate($this->name)['viewName'];
    }
}
