<?php

namespace Daugt\Models;

use Illuminate\Database\Eloquent\Model;
use Jaybizzle\CrawlerDetect\CrawlerDetect;

class AnalyticsEvent extends Model
{
    protected $casts = [
        'created_at' => 'datetime',
    ];


    public static function logModelEvent($model): void
    {
        if((new CrawlerDetect())->isCrawler()){
            return;
        }
        $event = new self();
        $event->sessionId = session()->getId();
        $event->eventable()->associate($model);
        $event->created_at = now();
        $event->save();
    }
}
