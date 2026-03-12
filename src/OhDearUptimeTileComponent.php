<?php

namespace Spatie\OhDearUptimeTile;

use Illuminate\Contracts\View\View;
use Spatie\Dashboard\Components\BaseTileComponent;

class OhDearUptimeTileComponent extends BaseTileComponent
{
    protected static $showTile = null;

    public function render(): View
    {
        $downSites = OhDearUptimeStore::make()->downSites();

        $showTile = isset(static::$showTile)
            ? (static::$showTile)($downSites)
            : true;

        $refreshIntervalInSeconds = config('dashboard.tiles.oh_dear_uptime.refresh_interval_in_seconds') ?? 5;

        return view('dashboard-oh-dear-uptime-tile::tile', compact('downSites', 'showTile', 'refreshIntervalInSeconds'));
    }

    public static function showTile(callable $callable): void
    {
        static::$showTile = $callable;
    }
}
