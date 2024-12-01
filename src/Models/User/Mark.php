<?php

namespace Daugt\Models\User;

use Daugt\Models\User;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}