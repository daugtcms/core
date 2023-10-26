<?php

namespace Felixbeer\SiteCore\Pages\Models;

use Felixbeer\SiteCore\Core\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;
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
