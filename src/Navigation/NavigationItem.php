<?php

namespace Felixbeer\SiteCore\Navigation;

use Illuminate\Database\Eloquent\Model;

class NavigationItem extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];
}
