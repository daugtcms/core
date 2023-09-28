<?php

namespace Felixbeer\SiteCore\Commands;

use Felixbeer\SiteCore\Jobs\DownloadIcons;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class SyncIcons extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'site-core:sync-icons';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $icons = collect(Storage::disk('sitecore-media')->allFiles('icons/default'));
        $icons->chunk(100)->each(function ($icons) {
            DownloadIcons::dispatch($icons);
        });
    }
}
