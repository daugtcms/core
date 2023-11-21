<?php

namespace Sitebrew\Models\Listing;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    public function items()
    {
        return $this->hasMany(ListingItem::class);
    }
}
