<?php

namespace Daugt\Models\Content;

use Illuminate\Database\Eloquent\Model;

class NotificationSetting extends Model
{

    public function subject()
    {
        return $this->morphTo();
    }
}
