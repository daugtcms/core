<?php

namespace Sitebrew\Livewire\Table;

use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Layout;
use Livewire\Component;

abstract class Table extends Component
{
    abstract public function columns(): array;

    abstract public function addElement(): void;

    public function data()
    {
        return $this
            ->query()
            ->get();
    }

    abstract public function query(): Builder;

    #[Layout('sitebrew::components.layouts.admin')]
    public function render()
    {
        return view('sitebrew::livewire.table.table');
    }
}
