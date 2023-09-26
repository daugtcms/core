<?php

namespace Felixbeer\SiteCore\Livewire;

use Felixbeer\SiteCore\Models\Navigation;
use Felixbeer\SiteCore\Models\NavigationItem;
use Livewire\Component;

class NavigationEditor extends Component
{
    /** @var NavigationItem[] */
    public array $items = [];

    public Navigation $currentNavigation;

    public function mount()
    {
    }

    public function render()
    {
        $navigations = Navigation::all();
        if ($navigations->count() > 0) {
            $this->currentNavigation = $navigations->first();
            $this->items = $this->currentNavigation->items;
        }

        return view('site-core::livewire.navigation-editor', [
            'navigations' => $navigations,
        ]);
    }
}
