<?php

namespace Sitebrew\Livewire\Content;

use Livewire\Features\SupportAttributes\AttributeCollection;
use Sitebrew\Livewire\Navigation\NavigationEditor;
use Sitebrew\Models\Content\Course;
use Sitebrew\Models\Navigation\Navigation;
use Livewire\Attributes\Rule;
use Sitebrew\Models\User;
use WireElements\Pro\Components\Modal\Modal;

class EditCourse extends Modal
{
    public int|Course $course;

    #[Rule('required')]
    public $name = '';

    #[Rule('nullable|before:ends_at')]
    public $starts_at = '';

    #[Rule('nullable|after:starts_at')]
    public $ends_at = '';

    public function mount(Course $course = null)
    {
        if ($course) {
            $this->name = $course->name;
            $this->starts_at = $course->starts_at;
            $this->ends_at = $course->ends_at;
            $this->course = $course;
        }
    }

    public function save()
    {
        $this->validate();
        if (isset($this->course->id)) {
            $this->course->update(
                $this->only(['name', 'starts_at', 'ends_at'])
            );
            $this->course->save();
        } else {
            Course::create(
                $this->only(['name', 'starts_at', 'ends_at'])
            );
        }

        $this->close(andDispatch: [
            CoursesTable::class => 'refreshComponent',
        ]);
    }

    public function render()
    {

        return view('sitebrew::livewire.content.edit-course', [

        ]);
    }

    public static function attributes(): array
    {
        return [
            'size' => '4xl',
        ];
    }
}
