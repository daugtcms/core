<?php

namespace Sitebrew\Models\Shop;

use Illuminate\Database\Eloquent\Model;
use Sitebrew\Models\Content\Content;
use Sitebrew\Models\User;
use Sitebrew\Traits\HasTranslations;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model
{
    use HasTranslatableSlug, HasTranslations;

    public $translatable = [
        'name',
        'slug',
    ];

    protected $casts = [
        'description' => 'array',
        'shipping' => 'boolean',
        'multi' => 'boolean',
        'starts_at' => 'date',
        'ends_at' => 'date',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function content() {
        return $this->belongsTo(Content::class);
    }

    public function prunable()
    {
        return static::where('created_at', '<=', now()->subYear());
    }
}
