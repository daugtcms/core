<?php

namespace Daugt\Livewire\Users;

use Daugt\Models\Content\Notification;
use Livewire\Attributes\Url;
use Daugt\Livewire\Table\Table;
use Daugt\Livewire\Table\Column;
use Daugt\Models\Content\Content;
use Illuminate\Database\Eloquent\Builder;

class NotificationTable extends Table
{

    protected $listeners = [
        'refreshComponent' => '$refresh',
    ];

    public array $searchableFields = ['title'];

    public bool $allowCreate = false;

    public function query(): Builder
    {
        $query = Notification::query();

        return $query;
    }

    public function columns(): array
    {
        return [
            Column::make('id', '')->component('daugt::table.view-notification-content'),
            Column::make('id', __('daugt::general.title')),
            Column::make('recipients_count', __('daugt::general.receipients_count')),
            Column::make('created_at', __('daugt::general.created_at'))->component('daugt::table.human-diff'),
        ];
    }

    public function add(): void
    {
    }

    public function edit($id): void
    {
    }
}
