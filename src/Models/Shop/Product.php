<?php

namespace Sitebrew\Models\Shop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Plank\Mediable\Mediable;
use Sitebrew\Models\Content\Content;
use Sitebrew\Models\Listing\ListingItem;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model
{
    use HasSlug, Mediable;

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

    public function categories(): MorphToMany
    {
        return $this->morphToMany(ListingItem::class, 'model', 'model_has_listing_items', 'model_id', 'listing_item_id');
    }
}
