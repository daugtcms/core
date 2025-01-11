<?php

namespace Daugt\Livewire\MemberArea;

use Daugt\Injectable\TiptapEditor;
use Daugt\Models\User\Comment;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\WithPagination;
use Daugt\Helpers\MemberArea\AccessHelper;
use Daugt\Models\Content\Content;
use Daugt\Models\Listing\Listing;
use Daugt\Models\Listing\ListingItem;

class CoursePosts extends Component
{
    use WithPagination;

    protected $listeners = [
        'refreshComponent' => '$refresh',
    ];

    public Listing $course;

    public string|ListingItem $section;

    public bool $emailNotifications = false;

    public function mount(Listing $course, string $section = null)
    {
        $this->course = $course;
        if($section) {
            $this->section = ListingItem::where('slug', $section)->first();
        }

        $this->emailNotifications = Auth::user()->notificationSettings()->where('notifiable_type', $this->course->getMorphClass())->where('notifiable_id', $course->id)->exists();
    }

    public function render()
    {
        $feedPagination = $this->getUnionFeed();

        $hydratedModels = $this->hydrateModels($feedPagination->items());

        $feedCollection = $this->reorderHydratedModels($feedPagination->items(), $hydratedModels);

        /*$mergedPaginated = new LengthAwarePaginator(
            $feedCollection,                  // Items for current page
            $feedPagination->total(),         // Total items
            $feedPagination->perPage(),       // Per page
            $feedPagination->currentPage(),   // Current page
            // [ 'path' => $feedPagination->path() ]
        );*/

        $feedPagination->setCollection($feedCollection);


        return view('daugt::livewire.member-area.course-posts', [
            'feed'                   => $feedPagination,
            'allow_member_comments'  => $this->course->data['allow_member_comments'] ?? false,
            'allow_member_reactions' => $this->course->data['allow_member_reactions'] ?? false,
        ]);
        /*$query = Content::query();
        $commentQuery = Comment::query();
         else {
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

                $commentQuery->where(function($query) use ($timeslots) {
                    $timeslots->each(function ($slot, $key) use (&$query) {
                        if ($key === 0) {
                            $query->whereBetween('created_at', [$slot['starts_at']->toDateTimeString(), $slot['ends_at']->toDateTimeString()]);
                        } else {
                            $query->orWhereBetween('created_at', [$slot['starts_at']->toDateTimeString(), $slot['ends_at']->toDateTimeString()]);
                        }
                    });
                });
                $query->orWhereJsonContains('attributes->freeForAll', true);
            }
        }

        $query = $query->orderBy('published_at', 'desc')->with(['comments','reactions']);
        $commentQuery = $commentQuery->orderBy('created_at', 'desc');

        return view('daugt::livewire.member-area.course-posts', [
            'course_posts' => $query->paginate(25),
            'allow_member_comments' => $this->course->data['allow_member_comments'] ?? false,
            'allow_member_reactions' => $this->course->data['allow_member_reactions'] ?? false,
        ]);*/
    }

    protected function getUnionFeed()
    {
        $timeslots = AccessHelper::canAccessCourse($this->course);

        // Build subquery for posts
        $postsSubquery = DB::table('contents')
            ->select([
                DB::raw("'post' AS model_type"),
                'id AS model_id',
                'published_at AS feed_date',
            ])
            ->where('type', 'post')
            ->where('published_at', '<=', now());

        if(isset($this->section) && $this->section instanceof ListingItem) {
            $postsSubquery = $postsSubquery->whereJsonContains('attributes->courseSections', $this->section->id);
        } else {
            $items = $this->course->items()->get()->pluck('id');
            $postsSubquery = $postsSubquery->where(function ($q) use ($items) {
                foreach ($items as $item) {
                    $q->orWhereJsonContains('attributes->courseSections', $item);
                }
            });
        }
        // Any time-slot filters or courseSections JSON filters go here:
        // e.g. if ($timeslots) { ... }
        // e.g. if ($this->section) { ... }
        // etc.

        // Build subquery for comments
        $commentsSubquery = DB::table('comments')
            ->select([
                DB::raw("'comment' AS model_type"),
                'id AS model_id',
                'created_at AS feed_date',
            ]);
        // Time slot logic for comments:
        // e.g. if ($timeslots) { ... }
        // Also filtering by $this->section, commentable_id, etc.

        if(isset($this->section) && $this->section instanceof ListingItem) {
            $commentsSubquery = $commentsSubquery->where('commentable_type', $this->section->getMorphClass())->where('commentable_id', $this->section->id);
        } else {
            $ids = $this->course->items()->get()->pluck('id');
            // TODO: Please replace string ("listing-item) with actual class function, but this doesnt work with static
            $commentsSubquery = $commentsSubquery->where('commentable_type', 'listing-item')->whereIn('commentable_id', $ids);
        }

        if(!$timeslots) {
            $postsSubquery->limit(0);
            $commentsSubquery->limit(0);
        } else if($timeslots instanceof Collection) {
            $postsSubquery->where(function($query) use ($timeslots) {
                $timeslots->each(function ($slot, $key) use (&$postsSubquery) {
                    if ($key === 0) {
                        $postsSubquery->whereBetween('published_at', [$slot['starts_at']->toDateTimeString(), $slot['ends_at']->toDateTimeString()]);
                    } else {
                        $postsSubquery->orWhereBetween('published_at', [$slot['starts_at']->toDateTimeString(), $slot['ends_at']->toDateTimeString()]);
                    }
                });
            });

            $postsSubquery->orWhereJsonContains('attributes->freeForAll', true);

            $commentsSubquery->where(function($query) use ($timeslots) {
                $timeslots->each(function ($slot, $key) use (&$commentsSubquery) {
                    if ($key === 0) {
                        $commentsSubquery->whereBetween('created_at', [$slot['starts_at']->toDateTimeString(), $slot['ends_at']->toDateTimeString()]);
                    } else {
                        $commentsSubquery->orWhereBetween('created_at', [$slot['starts_at']->toDateTimeString(), $slot['ends_at']->toDateTimeString()]);
                    }
                });
            });
        }

        // unionAll them
        $unionQuery = $postsSubquery->unionAll($commentsSubquery);

        // Wrap that union in an outer query to sort & paginate
        $feed = DB::table(DB::raw("({$unionQuery->toSql()}) AS feed"))
            ->mergeBindings($unionQuery)
            ->orderBy('feed.feed_date', 'desc')
            ->paginate(25);  // DB-driven pagination

        return $feed;
    }

    protected function hydrateModels($unionRows)
    {
        // 1) Separate IDs by model_type
        $postIds = [];
        $commentIds = [];
        foreach ($unionRows as $row) {
            if ($row->model_type === 'post') {
                $postIds[] = $row->model_id;
            } else {
                $commentIds[] = $row->model_id;
            }
        }

        // 2) Load each set from Eloquent with relationships
        // For posts: we might load 'comments', 'reactions', etc.
        // For comments: we might load 'reactions', 'comments' (subcomments), etc.
        $posts = Content::whereIn('id', $postIds)
            ->with(['comments.comments', 'reactions'])
            ->get()
            ->keyBy('id'); // so we can find them quickly by ID

        // For comments, we might load subcomments with a nested relationship
        // e.g. ->with(['reactions', 'comments.reactions']) if your Comment model
        // has something like `public function comments() { ... }` for subcomments
        $comments = Comment::whereIn('id', $commentIds)
            ->with(['comments', 'reactions'])
            ->withMediaAndVariants('media')
            ->get()
            ->keyBy('id');

        $comments->each(function ($comment) {
            $comment->text = !empty($comment->text) ? TiptapEditor::init(comment: true)->setContent($comment->text)->getHTML() : null;
            $comment->comments->each(function ($subcomment) {
                $subcomment->text = !empty($subcomment->text) ? TiptapEditor::init(comment: true)->setContent($subcomment->text)->getHTML() : null;
            });
        });

        // 3) Merge the two collections so we can easily look them up by (type, id)
        $merged = [
            'post' => $posts,
            'comment' => $comments,
        ];

        return $merged;
    }

    protected function reorderHydratedModels($unionRows, $hydratedModels)
    {
        $final = [];

        // $unionRows is the array of stdClass rows from the union-based paginator
        foreach ($unionRows as $row) {
            $type = $row->model_type;
            $id   = $row->model_id;

            // If it exists, push the hydrated model in the same order
            if (isset($hydratedModels[$type][$id])) {
                $final[] = $hydratedModels[$type][$id];
            }
        }

        return collect($final);
    }

    public function updatedEmailNotifications($value)
    {
        if($value) {
            Auth::user()->notificationSettings()->updateOrCreate([
                'notifiable_type' => $this->course->getMorphClass(),
                'notifiable_id' => $this->course->id,
            ]);
        } else {
            Auth::user()->notificationSettings()->where('notifiable_type', $this->course->getMorphClass())->where('notifiable_id', $this->course->id)->delete();
        }
    }
}
