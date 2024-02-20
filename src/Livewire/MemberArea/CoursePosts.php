<?php

namespace Sitebrew\Livewire\MemberArea;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\WithPagination;
use Sitebrew\Helpers\MemberArea\AccessHelper;
use Sitebrew\Models\Content\Content;
use Sitebrew\Models\Listing\Listing;
use Sitebrew\Models\Listing\ListingItem;
use Sitebrew\Models\User;

class CoursePosts extends Component
{
    use WithPagination;

    protected $listeners = [
        'refreshComponent' => '$refresh',
    ];

    public Listing $course;

    public string|ListingItem $section;

    public function mount(Listing $course, string $section = null)
    {
        $this->course = $course;
        if($section) {
            $this->section = ListingItem::where('slug', $section)->first();
        }
    }

    public function render()
    {
        $timeslots = AccessHelper::canAccessCourse($this->course);
        $query = Content::query();
        if(!$timeslots) {
            $query->limit(0);
        } else {
            $query = $query->where('type', 'post')->with('user');
            if($this->section instanceof ListingItem) {
                $query = $query->where('blocks->template->attributes->courseSection', $this->section->id);
            } else {
                $items = $this->course->items()->get()->pluck('id');
                $query = $query->whereIn('blocks->template->attributes->courseSection', $items);
            }
            $query = $query->where('published_at', '<=', now());
            if($timeslots instanceof Collection) {
                $query->where(function($query) use ($timeslots) {
                    $timeslots->each(function ($slot, $key) use (&$query) {
                        if ($key === 0) {
                            $query->whereBetween('published_at', [$slot['starts_at']->toDateTimeString(), $slot['ends_at']->toDateTimeString()]);
                        } else {
                            $query->orWhereBetween('published_at', [$slot['starts_at']->toDateTimeString(), $slot['ends_at']->toDateTimeString()]);
                        }
                    });
                });
            }
        }

        $query->orderBy('published_at', 'desc');
        return view('sitebrew::livewire.member-area.course-posts', [
            'course_posts' => $query->paginate(25)
        ]);
    }
}