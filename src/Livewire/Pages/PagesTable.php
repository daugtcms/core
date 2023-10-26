<?php

namespace Sitebrew\Livewire\Pages;

use Sitebrew\Livewire\Table\Table;
use Sitebrew\Livewire\Table\Column;
use Sitebrew\Models\Pages\Page;
use Illuminate\Database\Eloquent\Builder;

class PagesTable extends Table
{
    public function query(): Builder
    {
        return Page::query();
    }

    public function columns(): array
    {
        return [
            Column::make('id', '')->component('sitebrew::core.table.edit'),
            Column::make('title', 'Titel'),
            Column::make('description', 'Description'),
            Column::make('slug', 'URL'),
            Column::make('created_at', 'Created At')->component('sitebrew::core.table.human-diff'),
            Column::make('id', '')->component('sitebrew::core.table.delete'),
        ];
    }
}
