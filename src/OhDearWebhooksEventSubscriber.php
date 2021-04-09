<?php

namespace Spatie\OhDearUptimeTile;

use Illuminate\Events\Dispatcher;
use OhDear\LaravelWebhooks\OhDearWebhookCall;

class OhDearWebhooksEventSubscriber
{
    public function onUptimeCheckFailed(
        OhDearWebhookCall $ohDearWebhookCall,
        OhDearUptimeStore $ohDearUptimeStore
    ) {
        $site = $ohDearWebhookCall->site();

        $ohDearUptimeStore->markSiteAsDown($site['url']);
    }

    public function onUptimeCheckRecovered(
        OhDearWebhookCall $ohDearWebhookCall,
        OhDearUptimeStore $ohDearUptimeStore
    ) {
        $site = $ohDearWebhookCall->site();

        $ohDearUptimeStore->markSiteAsUp($site['url']);
    }

    public function subscribe(Dispatcher $events)
    {
        $events->listen(
            'ohdear-webhooks::uptimeCheckFailed',
            static::class . '@onUptimeCheckFailed',
        );

        $events->listen(
            'ohdear-webhooks::uptimeCheckRecovered',
            static::class . '@onUptimeCheckRecovered',
        );
    }
}
