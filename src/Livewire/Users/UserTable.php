<?php

namespace Sitebrew\Livewire\Users;

use Livewire\Attributes\Url;
use Sitebrew\Livewire\Table\Table;
use Sitebrew\Livewire\Table\Column;
use Sitebrew\Models\Content\Content;
use Illuminate\Database\Eloquent\Builder;
use Sitebrew\Models\User;

class UserTable extends Table
{

    protected $listeners = [
        'refreshComponent' => '$refresh',
    ];

    public bool $allowCreate = false;

    public function query(): Builder
    {
        $query = User::query();

        return $query;
    }

    public function add(): void
    {
        $this->dispatch('modal.open', 'sitebrew::users.edit-user', [
            'data' => [],
        ]);
    }

    public function edit($id): void
    {
        $this->dispatch('modal.open', 'sitebrew::users.edit-user', [
            'user' => $id
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make('id', '')->component('sitebrew::table.edit'),
            Column::make('id', __('sitebrew::general.id')),
            Column::make('name', __('sitebrew::general.username')),
            Column::make('', __('sitebrew::general.name'))->component('sitebrew::table.user'),
            // Column::make('slug', 'URL'),
            Column::make('created_at', __('sitebrew::general.created_at'))->component('sitebrew::table.human-diff'),
            // Column::make('id', '')->component('sitebrew::table.delete'),
        ];
    }

    public function saveBlocks($data, $id)
    {

    }
}
