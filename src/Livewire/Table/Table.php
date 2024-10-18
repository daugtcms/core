<?php

namespace Daugt\Livewire\Table;

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

    public array $filters = [];

    abstract public function columns(): array;

    public function data()
    {
        $query = $this->filter($this->query(), $this->filters);
        return $query->get();
    }

    abstract public function query(): Builder;

    private function filter(Builder $query, $filters): Builder
    {
        foreach ($filters as $field => $filter) {
            // Check if the filter is an array with an operator
            if (is_array($filter) && count($filter) === 2) {
                [$operator, $value] = $filter;
            } else {
                // Default to '=' if no operator is specified
                $operator = '=';
                $value = $filter;
            }

            // Apply the filter to the query
            $query->where($field, $operator, $value);
        }
        return $query;
    }

    public function updatedSelected($key, $value): void {
        $this->dispatch('updateSelectedItems', array_keys($this->selected));
    }

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

    #[Layout('daugt::components.layouts.admin')]
    public function render()
    {
        return view('daugt::livewire.table.table');
    }
}
