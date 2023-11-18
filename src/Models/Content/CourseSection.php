<?php

namespace Sitebrew\Models\Content;

use Illuminate\Database\Eloquent\Model;
use Sitebrew\Models\User;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class CourseSection extends Model implements Sortable
{
    use HasSlug, SortableTrait;

    public $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true,
    ];

    protected $casts = [
        'users_can_comment' => 'boolean',
        'users_can_post' => 'boolean',
        'users_can_post_anonymously' => 'boolean',
    ];

    public function course() {
        return $this->belongsTo(Course::class);
    }
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}
