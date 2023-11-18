<?php

namespace Sitebrew\Livewire\Content;

use Sitebrew\Livewire\Table\Table;
use Sitebrew\Livewire\Table\Column;
use Illuminate\Database\Eloquent\Builder;
use Sitebrew\Models\Content\Course;
use Sitebrew\Models\Content\CourseSection;
use Sitebrew\Models\User;

class CourseSectionsTable extends Table
{

    public bool $sortable = true;

    public bool $fullWidth = true;

    protected $listeners = [
        'refreshComponent' => '$refresh',
    ];

    public int|Course $course;

    public bool $allowCreate = true;

    public function mount(Course $course)
    {
        $this->course = $course;
    }

    public function query(): Builder
    {
        $query = CourseSection::where('course_id', $this->course->id)->orderBy('order');

        return $query;
    }

    public function add(): void
    {
        $this->dispatch('modal.open', 'sitebrew::content.edit-course-section', [
            'course' => $this->course->id
        ]);
    }

    public function edit($id): void
    {
        $this->dispatch('modal.open', 'sitebrew::content.edit-course-section', [
            'course' => $this->course->id,
            'section' => $id
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make('', '')->component('sitebrew::table.sort-handle'),
            Column::make('id', '')->component('sitebrew::table.edit'),
            Column::make('name', __('sitebrew::general.name')),
            Column::make('created_at', __('sitebrew::general.created_at'))->component('sitebrew::table.human-diff'),
            // Column::make('id', '')->component('sitebrew::table.delete'),
        ];
    }

    public function updateSortOrder($data): void
    {
        CourseSection::setNewOrder(collect($data)->sortBy('order')->map(function ($item, $index) {
            return $item['value'];
        })->toArray());
    }
}
