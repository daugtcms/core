<?php

namespace Felixbeer\SiteCore\Navigation\Models;

use Felixbeer\SiteCore\Core\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class Navigation extends Model
{
    use HasTranslations;

    public $translatable = [
        'name',
        'description',
    ];

    public function items()
    {
        return $this->hasMany(NavigationItem::class);
    }
}
