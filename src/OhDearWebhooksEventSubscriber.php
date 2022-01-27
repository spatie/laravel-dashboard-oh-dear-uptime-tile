<?php

namespace Spatie\OhDearUptimeTile;

use Illuminate\Events\Dispatcher;
use OhDear\LaravelWebhooks\OhDearWebhookCall;

class OhDearWebhooksEventSubscriber
{
    public function onUptimeCheckFailed(
        OhDearWebhookCall $ohDearWebhookCall
    ) {
        $site = $ohDearWebhookCall->site();

        (new OhDearUptimeStore)->markSiteAsDown($site['url']);
    }

    public function onUptimeCheckRecovered(
        OhDearWebhookCall $ohDearWebhookCall
    ) {
        $site = $ohDearWebhookCall->site();

        (new OhDearUptimeStore)->markSiteAsUp($site['url']);
    }

    public function subscribe(Dispatcher $events)
    {
        $events->listen(
            'ohdear-webhooks::uptimeCheckFailedNotification',
            static::class . '@onUptimeCheckFailed',
        );

        $events->listen(
            'ohdear-webhooks::uptimeCheckRecoveredNotification',
            static::class . '@onUptimeCheckRecovered',
        );
    }
}
