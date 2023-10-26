<?php

namespace Sitebrew\Commands;

use Sitebrew\Jobs\DownloadIcons;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class SyncIcons extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitebrew:sync-icons';

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
        $icons = collect(Storage::disk('sitebrew-media')->files('icons/default'));
        $icons->chunk(100)->each(function ($icons) {
            DownloadIcons::dispatch($icons);
        });
    }
}
