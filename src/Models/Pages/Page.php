<?php

namespace Sitebrew\Models\Pages;

use Illuminate\Database\Eloquent\Model;
use Sitebrew\Traits\HasTranslations;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;

class Page extends Model
{
    use HasTranslatableSlug, HasTranslations;

    public $translatable = [
        'title',
        'description',
        'slug',
    ];

    protected $casts = [
        'blocks' => 'array',
        'meta' => 'array',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
}
