<?php

namespace App\Console\Commands;

use App\Models\Lead;
use Illuminate\Console\Command;

class LeadsCleanup extends Command
{
    protected $signature   = 'leads:cleanup';
    protected $description = 'Archive leads older than 365 days';

    public function handle(): int
    {
        $count = Lead::where('created_at', '<', now()->subDays(365))
                     ->whereNotIn('status', ['archived'])
                     ->update(['status' => 'archived']);

        $this->info("Archived {$count} old leads.");
        return self::SUCCESS;
    }
}
