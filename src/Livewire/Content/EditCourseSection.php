<?php

namespace Sitebrew\Livewire\Content;

use Livewire\Features\SupportAttributes\AttributeCollection;
use Sitebrew\Livewire\Listing\NavigationEditor;
use Sitebrew\Models\Content\Course;
use Sitebrew\Models\Content\CourseSection;
use Sitebrew\Models\Listing\Navigation;
use Livewire\Attributes\Rule;
use Sitebrew\Models\User;
use WireElements\Pro\Components\Modal\Modal;

class EditCourseSection extends Modal
{
    public int|CourseSection $section;

    public int|Course $course;

    #[Rule('required')]
    public $name = '';

    public $users_can_comment = true;

    public $users_can_post = true;

    public $users_can_post_anonymously = false;

    public function mount(Course $course, CourseSection $section = null)
    {
        if (isset($section->id)) {
            $this->name = $section->name;
            $this->users_can_comment = $section->users_can_comment;
            $this->users_can_post = $section->users_can_post;
            $this->users_can_post_anonymously = $section->users_can_post_anonymously;
            $this->section = $section;
        }
        if(isset($course->id)) {
            $this->course = $course;
        }
    }

    public function save()
    {
        $this->validate();

        if (isset($this->section->id)) {
            $this->section->update(
                [...$this->only(['name', 'users_can_comment', 'users_can_post', 'users_can_post_anonymously']), 'course_id' => $this->course->id]
            );

            $this->section->save();
        } else {
            CourseSection::create(
                [...$this->only(['name', 'users_can_comment', 'users_can_post', 'users_can_post_anonymously']), 'course_id' => $this->course->id]
            );
        }

        $this->close(andDispatch: [
            EditCourse::class => 'refreshComponent',
        ]);
    }

    public function delete($id) {
        CourseSection::destroy($id);

        $this->close(andDispatch: [
            EditCourse::class => 'refreshComponent',
        ]);
    }

    public function render()
    {
        return view('sitebrew::livewire.content.edit-course-section');
    }

    public static function attributes(): array
    {
        return [
            'size' => 'md',
        ];
    }
}
