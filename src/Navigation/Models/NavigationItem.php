<?php

namespace Felixbeer\SiteCore\Navigation\Models;

use Felixbeer\SiteCore\Core\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class NavigationItem extends Model
{
    use HasTranslations;

    public $translatable = [
        'name',
        'description',
        'url',
    ];
}
