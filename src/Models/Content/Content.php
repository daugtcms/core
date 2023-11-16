<?php

namespace Sitebrew\Models\Content;

use Illuminate\Database\Eloquent\Model;
use Sitebrew\Models\User;
use Sitebrew\Traits\HasTranslations;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;

class Content extends Model
{
    use HasTranslatableSlug, HasTranslations;

    public $translatable = [
        'title',
        'slug',
    ];

    protected $casts = [
        'blocks' => 'array',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
