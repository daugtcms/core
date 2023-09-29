<?php

namespace Felixbeer\SiteCore\Livewire;

use Felixbeer\SiteCore\Navigation\Navigation;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use Livewire\Component;

class NavigationEditor extends Component
{
    public Collection $items;

    public Navigation $currentNavigation;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount()
    {
    }

    #[Layout('site-core::components.layouts.app')]
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
