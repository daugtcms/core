<?php

namespace Sitebrew\Livewire\Table;

use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Layout;
use Livewire\Component;

abstract class Table extends Component
{
    public bool $allowCreate = true;

    public bool $sortable = false;

    public bool $fullWidth = false;

    abstract public function columns(): array;

    public function data()
    {
        return $this
            ->query()
            ->get();
    }

    abstract public function query(): Builder;

    abstract public function add(): void;

    abstract public function edit($id): void;

    public function updateSortOrder($data): void {
    }

    #[Layout('sitebrew::components.layouts.admin')]
    public function render()
    {
        return view('sitebrew::livewire.table.table');
    }
}
