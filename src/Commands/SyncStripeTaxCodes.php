<?php

namespace Daugt\Commands;

use Illuminate\Support\Facades\DB;
use Daugt\Jobs\DownloadIcons;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Daugt\Models\Shop\StripeTaxCode;

class SyncStripeTaxCodes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daugt:sync-stripe-tax-codes';

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
        $client = new \Stripe\StripeClient(config('daugt.stripe.secret'));
        $taxCodes = $client->taxCodes->all(['limit' => 100]);

        foreach($taxCodes->autoPagingIterator() as $taxCode) {
            $this->info("Syncing tax code {$taxCode->id}...");

            StripeTaxCode::updateOrInsert(
                ['id' => $taxCode->id],
                [
                    'description' => $taxCode->description,
                    'name' => $taxCode->name,
                ]
            );
        }
    }
}
