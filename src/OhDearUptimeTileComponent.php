<?php

namespace Spatie\OhDearUptimeTile;

use App\Tiles\Uptime\OhDearUptimeStore;

class OhDearUptimeTileComponent
{
    /** @var string */
    public $position;

    public function mount(string $position)
    {
        $this->position = $position;
    }

    public function render()
    {
        return view('dashboard-oh-dear-uptime-tile::tile', [
            'downSites' => OhDearUptimeStore::make()->downSites(),
        ]);
    }
}
