<?php

namespace Spatie\OhDearUptimeTile;

use Spatie\Dashboard\Models\Tile;

class OhDearUptimeStore
{
    public static function make()
    {
        return new static();
    }

    public function markSiteAsDown(string $siteUrl): self
    {
        $downSites = $this->downSites();

        $downSites[] = $siteUrl;

        $uniqueDownSites = array_unique($downSites);

        $this->getTile()->putData('downSites', $uniqueDownSites);

        return $this;
    }

    public function markSiteAsUp(string $upSiteUrl): self
    {
        $downSites = $this->downSites();

        $downSites = array_filter($downSites, fn ($downSite) => $downSite !== $upSiteUrl);

        $this->getTile()->putData('downSites', $downSites);

        return $this;
    }

    public function clearDownSites(): self
    {
        $this->getTile()->putData('downSites', []);

        return $this;
    }

    public function downSites(): array
    {
        return $this->getTile()->getData('downSites') ?? [];
    }

    protected function getTile(): Tile
    {
        static $tile = null;

        $tile ??= Tile::firstOrCreateForName('ohDearUptime');

        return $tile;
    }
}
