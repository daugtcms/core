<?php

namespace Felixbeer\SiteCore\Livewire\Core\Table;

use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

abstract class Table extends Component
{
    abstract public function columns(): array;

    public function data()
    {
        return $this
            ->query()
            ->get();
    }

    abstract public function query(): Builder;

    public function render()
    {
        return view('site-core::livewire.core.table.table');
    }
}
