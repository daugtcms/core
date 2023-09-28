<?php

namespace Felixbeer\SiteCore\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class DownloadIcons implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Collection $icons;

    public function __construct($icons)
    {
        $this->icons = $icons;
    }

    public function handle()
    {
        $this->icons->each(function ($icon) {
            Storage::put($icon, Storage::disk('sitecore-media')->get($icon));
        });
    }
}
