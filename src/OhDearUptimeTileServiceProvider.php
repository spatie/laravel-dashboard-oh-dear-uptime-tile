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
        parent::boot();

        Livewire::component('oh-dear-uptime-tile', OhDearUptimeTileComponent::class);

        if ($this->app->runningInConsole()) {
            $this->commands([
                ClearOhDearDownSitesCommand::class,
            ]);
        }

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/dashboard-oh-dear-uptime-tile'),
        ], 'dashboard-oh-dear-uptime-tile-views');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'dashboard-oh-dear-uptime-tile');
    }
}
