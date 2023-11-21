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

    public bool $selectable = false;

    public bool $multiSelect = false;

    public bool $readonly = false;

    public array $selected = [];

    public array $ids = [];

    abstract public function columns(): array;

    public function data()
    {
        return $this
            ->query()
            ->get();
    }

    public function updatedSelected($value): void {
        if(!$this->multiSelect) {
            $this->selected = [$value];
        }

        $this->dispatch('updateSelectedItems', $this->multiSelect ? $this->selected : $value);
    }

    abstract public function query(): Builder;

    abstract public function add(): void;

    abstract public function edit($id): void;

    public function toggleEnabled($id): void {
    }

    public function select($id): void {
        if ($this->multiSelect) {
            if (in_array($id, $this->selected)) {
                $this->selected = array_diff($this->selected, [$id]);
            } else {
                $this->selected[] = $id;
            }
        } else {
            $this->selected = [$id];
        }
    }

    public function updateSortOrder($data): void {
    }

    #[Layout('sitebrew::components.layouts.admin')]
    public function render()
    {
        return view('sitebrew::livewire.table.table');
    }
}
