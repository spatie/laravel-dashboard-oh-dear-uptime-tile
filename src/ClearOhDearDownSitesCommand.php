<?php

namespace Spatie\OhDearUptimeTile;

use Illuminate\Console\Command;

class ClearOhDearDownSitesCommand extends Command
{
    protected $signature = 'dashboard:clear-oh-dear-down-sites';

    protected $description = 'Clear all sites that are down';

    public function handle()
    {
        $this->info('Clearing down sites...');

        OhDearUptimeStore::make()->clearDownSites();

        $this->info('All done!');
    }
}
