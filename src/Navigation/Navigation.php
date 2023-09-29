<?php

namespace Felixbeer\SiteCore\Navigation;

use Illuminate\Database\Eloquent\Model;

class Navigation extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function items()
    {
        return $this->hasMany(NavigationItem::class);
    }
}
