<?php

namespace Sitebrew\Models\Content;

use Illuminate\Database\Eloquent\Model;
use Sitebrew\Models\User;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Course extends Model
{
    use HasSlug;

    protected $casts = [
        'starts_at' => 'date',
        'ends_at' => 'date',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}
