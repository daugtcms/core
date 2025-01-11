<?php

namespace Daugt\Livewire\Content\Notifications;

use Daugt\Models\Content\Notification;
use Livewire\Attributes\Url;
use Daugt\Livewire\Table\Table;
use Daugt\Livewire\Table\Column;
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
        $query = Notification::query()->orderBy('created_at', 'desc');

        return $query;
    }

    public function columns(): array
    {
        return [
            Column::make('preview', __('daugt::content.notification.preview'))->component('daugt::table.view-notification-content'),
            Column::make('title', __('daugt::general.title')),
            Column::make('recipients_count', __('daugt::content.recipients_count')),
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
