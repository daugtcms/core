<?php

namespace Sitebrew\Models\Shop;

use Illuminate\Database\Eloquent\Model;
use Sitebrew\Models\User;

class Order extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
