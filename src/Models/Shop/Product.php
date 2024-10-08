<?php

namespace Daugt\Models\Shop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Plank\Mediable\Mediable;
use Daugt\Injectable\StripeClient;
use Daugt\Jobs\Shop\SyncStripeProduct;
use Daugt\Models\Content\Content;
use Daugt\Models\Content\Course;
use Daugt\Models\Listing\Listing;
use Daugt\Models\Listing\ListingItem;
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
        'enabled' => 'boolean',
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

    public function course() {
        return $this->belongsTo(Listing::class, 'course_id');
    }

    protected static function boot(): void
    {
        parent::boot();
        static::updated(function ($product) {
            SyncStripeProduct::dispatch($product);
        });
    }
}
