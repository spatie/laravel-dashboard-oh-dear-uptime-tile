<?php

namespace Spatie\OhDearUptimeTile;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class OhDearUptimeTileServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Event::subscribe(OhDearWebhooksEventSubscriber::class);

        Livewire::component('oh-dear-uptime-tile', OhDearUptimeTileComponent::class);

        if ($this->app->runningInConsole()) {
            $this->commands([
                ClearOhDearDownSitesCommand::class,
            ]);
        }

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/dashboard-oh-dear-uptime-tile'),
        ], 'dashboard-oh-dear-uptime-tile-views');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'dashboard-oh-dear-uptime-tile');
    }
}
