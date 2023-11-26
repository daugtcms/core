<?php

namespace Sitebrew\Models\Shop;

use Illuminate\Database\Eloquent\Model;

class StripeTaxCode extends Model
{
    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';
}
