<?php

namespace Sitebrew\Livewire\Pages;

use Sitebrew\Core\Table\Column;
use Sitebrew\Livewire\Core\Table\Table;
use Sitebrew\Pages\Models\Page;
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
