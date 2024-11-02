<?php

namespace Daugt\Models\Listing;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Listing extends Model
{
    use HasSlug;

    protected $casts = [
        'data' => 'array',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    protected $primaryKey = 'id';
    public function items()
    {
        return $this->hasMany(ListingItem::class)->orderBy('order');
    }

    protected static function booted()
    {
        static::updated(function ($listing) {
            if ($listing->isDirty('type')) {
                // Update the 'type' of all associated listing_items
                $listing->listingItems()->update(['listing_type' => $listing->type]);
            }
        });
    }
}
