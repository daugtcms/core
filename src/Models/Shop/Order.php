<?php

namespace Daugt\Models\Shop;

use Illuminate\Database\Eloquent\Model;
use Daugt\Models\User;

class Order extends Model
{
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'payment_succeeded_at' => 'datetime',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
