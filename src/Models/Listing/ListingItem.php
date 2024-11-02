<?php

namespace Daugt\Models\Listing;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class ListingItem extends Model
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

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }

    protected static function boot() {
        parent::boot();
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('order');
        });
    }
    protected static function booted()
    {
        static::creating(function ($listingItem) {
            if ($listingItem->listing_id && !$listingItem->listing_type) {
                $listingItem->listing_type = Listing::find($listingItem->listing_id)->type;
            }
        });
    }
}
