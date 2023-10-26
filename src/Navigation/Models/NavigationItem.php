<?php

namespace Sitebrew\Navigation\Models;

use Sitebrew\Core\Traits\HasTranslations;
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
