<?php

namespace Felixbeer\SiteCore\Livewire\Pages;

use Felixbeer\SiteCore\Core\Table\Column;
use Felixbeer\SiteCore\Livewire\Core\Table\Table;
use Felixbeer\SiteCore\Pages\Models\Page;
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
            Column::make('id', '')->component('site-core::core.table.edit'),
            Column::make('title', 'Titel'),
            Column::make('description', 'Description'),
            Column::make('slug', 'URL'),
            Column::make('created_at', 'Created At')->component('site-core::core.table.human-diff'),
            Column::make('id', '')->component('site-core::core.table.delete'),
        ];
    }
}
