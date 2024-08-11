<?php

namespace Daugt\Models\Blocks;

use Illuminate\Database\Eloquent\Model;

class BlockDefaults extends Model
{
    protected $casts = [
        'attributes' => 'array'
    ];
}
