<?php

namespace Daugt\Livewire\Listing;

use Daugt\Livewire\Table\Table;
use Daugt\Livewire\Table\Column;
use Daugt\Models\Listing\Listing;
use Illuminate\Database\Eloquent\Builder;

class ListingTable extends Table
{

    protected $listeners = [
        'refreshComponent' => '$refresh',
    ];

    public bool $allowCreate = false;

    public function query(): Builder
    {
        return Listing::query();
    }

    public function add(): void
    {
    }

    public function edit($id): void
    {
    }

    public function columns(): array
    {
        return [
            Column::make('id', __('daugt::general.id')),
            Column::make('name', __('daugt::general.name')),
            Column::make('created_at', __('daugt::general.created_at'))->component('daugt::table.human-diff'),
        ];
    }
}
