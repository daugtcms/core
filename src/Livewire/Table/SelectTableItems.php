<?php

namespace Daugt\Livewire\Table;

use LivewireUI\Modal\ModalComponent;

class SelectTableItems extends ModalComponent
{
    public string $tableName;

    public string $dispatch;

    public array $selected;

    public bool $multiSelect;

    public array $filters;

    protected $listeners = [
        'updateSelectedItems' => 'updateSelectedItems',
    ];

    public function updateSelectedItems($items): void
    {
        $this->dispatch($this->dispatch, $items);
    }

    public function render()
    {

        return view('daugt::livewire.table.select-table-items', [

        ]);
    }

    public static function modalMaxWidth(): string
    {
        return 'xl';
    }

    public static function destroyOnClose(): bool
    {
        return true;
    }
}
