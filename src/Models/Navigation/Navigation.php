<?php

namespace Sitebrew\Models\Navigation;

use Sitebrew\Traits\HasTranslations;
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
