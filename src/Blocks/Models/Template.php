<?php

namespace Sitebrew\Blocks\Models;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $casts = [
        'data' => 'array',
    ];
}
