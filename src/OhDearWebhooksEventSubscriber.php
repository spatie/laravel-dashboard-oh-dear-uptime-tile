<?php

namespace Spatie\OhDearUptimeTile;

use Illuminate\Events\Dispatcher;
use OhDear\LaravelWebhooks\OhDearWebhookCall;

class OhDearWebhooksEventSubscriber
{
    public function onUptimeCheckFailed(
        OhDearWebhookCall $ohDearWebhookCall
    ): void {
        $monitor = $ohDearWebhookCall->monitor();

        (new OhDearUptimeStore)->markSiteAsDown($monitor['url']);
    }

    public function onUptimeCheckRecovered(
        OhDearWebhookCall $ohDearWebhookCall
    ): void {
        $monitor = $ohDearWebhookCall->monitor();

        (new OhDearUptimeStore)->markSiteAsUp($monitor['url']);
    }

    public function subscribe(Dispatcher $events): void
    {
        $events->listen(
            'ohdear-webhooks::uptimeCheckFailed',
            static::class.'@onUptimeCheckFailed',
        );

        $events->listen(
            'ohdear-webhooks::uptimeCheckRecovered',
            static::class.'@onUptimeCheckRecovered',
        );
    }
}
