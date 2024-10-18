<?php

namespace Daugt\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BaseJob implements ShouldQueue
{
    public function tags()
    {
        if(function_exists('tenant')) {
            return [
                'tenant:' . tenant('id'),
            ];
        } else {
            return [];
        }
    }
}