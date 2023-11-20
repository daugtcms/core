<?php

namespace Sitebrew\Models\Blocks;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $casts = [
        'data' => 'array',
        'available_blocks' => 'array'
    ];
}
