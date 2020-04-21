<?php

namespace Spatie\OhDearUptimeTile;

use Livewire\Component;

class OhDearUptimeTileComponent extends Component
{
    protected static $showTile = null;

    /** @var string */
    public $position;

    public function mount(string $position)
    {
        $this->position = $position;
    }

    public function render()
    {
        $downSites = OhDearUptimeStore::make()->downSites();

        $showTile = isset(static::$showTile)
            ? (static::$showTile)($downSites)
            : true;

        return view('dashboard-oh-dear-uptime-tile::tile', compact('downSites', 'showTile'));
    }

    public static function showTile(callable $callable): void
    {
        static::$showTile = $callable;
    }
}

