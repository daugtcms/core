<?php

namespace Sitebrew\Models\Navigation;

use Illuminate\Database\Eloquent\Model;

class Navigation extends Model
{
    public function items()
    {
        return $this->hasMany(NavigationItem::class);
    }
}
