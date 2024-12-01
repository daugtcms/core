<?php

namespace Daugt\Livewire\MemberArea;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\WithPagination;
use Daugt\Helpers\MemberArea\AccessHelper;
use Daugt\Models\Content\Content;
use Daugt\Models\Listing\Listing;
use Daugt\Models\Listing\ListingItem;
use Daugt\Models\User;

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
            if(isset($this->section) && $this->section instanceof ListingItem) {
                $query = $query->whereJsonContains('attributes->courseSections', $this->section->id);
            } else {
                $items = $this->course->items()->get()->pluck('id');
                $query = $query->where(function ($q) use ($items) {
                    foreach ($items as $item) {
                        $q->orWhereJsonContains('attributes->courseSections', $item);
                    }
                });
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
                $query->orWhereJsonContains('attributes->freeForAll', true);
            }
        }

        $query->orderBy('published_at', 'desc');
        return view('daugt::livewire.member-area.course-posts', [
            'course_posts' => $query->with(['comments','reactions'])->paginate(25),
            'allow_member_comments' => $this->course->data['allow_member_comments'] ?? false,
            'allow_member_reactions' => $this->course->data['allow_member_reactions'] ?? false,
        ]);
    }
}
