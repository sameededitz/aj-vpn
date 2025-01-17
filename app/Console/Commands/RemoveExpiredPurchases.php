<?php

namespace App\Console\Commands;

use App\Models\Purchase;
use Illuminate\Console\Command;

class RemoveExpiredPurchases extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'purchases:remove-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove expired user purchases from the database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Starting to remove expired purchases...');

        // Fetch and delete expired purchases
        $expiredPurchases = Purchase::where('expires_at', '<', now())->delete();

        // Log the result
        if ($expiredPurchases) {
            $this->info("Successfully removed {$expiredPurchases} expired purchases.");
        } else {
            $this->info('No expired purchases found to remove.');
        }

        return 0;
    }
}
