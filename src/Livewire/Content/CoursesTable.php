<?php

namespace Sitebrew\Livewire\Content;

use Sitebrew\Livewire\Table\Table;
use Sitebrew\Livewire\Table\Column;
use Illuminate\Database\Eloquent\Builder;
use Sitebrew\Models\Content\Course;
use Sitebrew\Models\User;

class CoursesTable extends Table
{

    protected $listeners = [
        'refreshComponent' => '$refresh',
    ];

    public bool $allowCreate = true;

    public function query(): Builder
    {
        $query = Course::query();

        return $query;
    }

    public function add(): void
    {
        $this->dispatch('modal.open', 'sitebrew::content.edit-course');
    }

    public function edit($id): void
    {
        $this->dispatch('modal.open', 'sitebrew::content.edit-course', [
            'course' => $id
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make('id', '')->component('sitebrew::table.edit'),
            Column::make('name', __('sitebrew::general.name')),
            Column::make('created_at', __('sitebrew::general.created_at'))->component('sitebrew::table.human-diff'),
            // Column::make('id', '')->component('sitebrew::table.delete'),
        ];
    }

    public function saveBlocks($data, $id)
    {

    }
}
