<?php

namespace Daugt\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Jaybizzle\CrawlerDetect\CrawlerDetect;

class AnalyticsEvent extends Model
{
    public $incrementing = false;
    public $timestamps = false;

    protected $casts = [
        'created_at' => 'datetime',
    ];


    public static function logModelEvent($model): void
    {
        if((new CrawlerDetect())->isCrawler()) {
            return;
        }
        if(auth()->check() && auth()->user()->can('access admin panel')) {
            return;
        }
        $event = new self();
        $event->uuid = (string) Str::uuid();
        $event->session_id = session()->getId();
        $event->eventable()->associate($model);
        $event->created_at = now();
        $event->save();
    }

    public function eventable()
    {
        return $this->morphTo();
    }
}
