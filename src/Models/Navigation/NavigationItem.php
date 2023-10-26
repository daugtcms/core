<?php

namespace Sitebrew\Models\Navigation;

use Sitebrew\Traits\HasTranslations;
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
