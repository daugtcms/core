<?php

namespace Sitebrew\Models\Listing;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    protected $primaryKey = 'id';
    public function items()
    {
        return $this->hasMany(ListingItem::class);
    }
}
