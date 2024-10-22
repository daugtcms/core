<?php

namespace Daugt\Models\Shop;

use Carbon\Carbon;
use Daugt\Enums\Shop\AccessType;
use Daugt\Models\Content\Content;
use Daugt\Models\Listing\Listing;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Daugt\Models\User;

class OrderItem extends Model
{
    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'payment_succeeded_at' => 'datetime',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getAccessTimestamps(Listing|Content $accessItem) {
        switch($accessItem->pivot->type) {
            case AccessType::PERMANENT->value:
                return [
                    'starts_at' => null,
                    'ends_at' => null,
                ];
            case AccessType::DURATION->value:
                $endDate = $this->order->payment_succeeded_at->add($accessItem->pivot->duration, $accessItem->pivot->duration_unit);
                return [
                    'starts_at' => $this->order->payment_succeeded_at,
                    'ends_at' => $endDate,
                ];
            case AccessType::DATES->value:
                return [
                    'starts_at' => Carbon::parse($accessItem->pivot->start_date),
                    'ends_at' => Carbon::parse($accessItem->pivot->end_date),
                ];
        }
    }
}
