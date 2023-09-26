<?php

namespace Felixbeer\SiteCore\Models;

use Illuminate\Database\Eloquent\Model;

class NavigationItem extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];
}
