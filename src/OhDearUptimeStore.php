<?php

namespace Spatie\OhDearUptimeTile;

use Spatie\Dashboard\Models\Tile;

class OhDearUptimeStore
{
    private Tile $tile;

    public static function make()
    {
        return new static();
    }

    public function __construct()
    {
        $this->tile = Tile::firstOrCreateForName('ohDearUptime');
    }

    public function markSiteAsDown(string $siteUrl): self
    {
        $downSites = $this->downSites();

        $downSites[] = $siteUrl;

        $uniqueDownSites = array_unique($downSites);

        $this->tile->putData('downSites', $uniqueDownSites);

        return $this;
    }

    public function markSiteAsUp(string $upSiteUrl): self
    {
        $downSites = $this->downSites();

        $downSites = array_filter($downSites, fn ($downSite) => $downSite !== $upSiteUrl);

        $this->tile->putData('downSites', $downSites);

        return $this;
    }

    public function clearDownSites(): self
    {
        $this->tile->putData('downSites', []);

        return $this;
    }

    public function downSites(): array
    {
        return $this->tile->getData('downSites') ?? [];
    }
}
