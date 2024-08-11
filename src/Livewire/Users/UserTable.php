<?php

namespace Daugt\Livewire\Users;

use Livewire\Attributes\Url;
use Daugt\Livewire\Table\Table;
use Daugt\Livewire\Table\Column;
use Daugt\Models\Content\Content;
use Illuminate\Database\Eloquent\Builder;
use Daugt\Models\User;

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
        $this->dispatch('openModal', 'daugt::users.edit-user', [
            'data' => [],
        ]);
    }

    public function edit($id): void
    {
        $this->dispatch('openModal', 'daugt::users.edit-user', [
            'user' => $id
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make('id', '')->component('daugt::table.edit'),
            Column::make('id', __('daugt::general.id')),
            Column::make('name', __('daugt::general.username')),
            Column::make('', __('daugt::general.name'))->component('daugt::table.user'),
            // Column::make('slug', 'URL'),
            Column::make('created_at', __('daugt::general.created_at'))->component('daugt::table.human-diff'),
            // Column::make('id', '')->component('daugt::table.delete'),
        ];
    }

    public function saveBlocks($data, $id)
    {

    }
}
