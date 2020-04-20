<?php

namespace Spatie\OhDearUptimeTile;

use Illuminate\Foundation\Support\Providers\EventServiceProvider;
use Livewire\Livewire;

class OhDearUptimeTileServiceProvider extends EventServiceProvider
{
    protected $subscribe = [
        OhDearWebhooksEventSubscriber::class,
    ];

    public function boot()
    {
        Livewire::component('oh-dear-uptime-tile', OhDearUptimeTileComponent::class);

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'dashboard-oh-dear-uptime-tile');
    }
}
