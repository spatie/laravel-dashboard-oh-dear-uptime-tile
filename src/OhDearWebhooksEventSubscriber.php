<?php

namespace Spatie\OhDearUptimeTile;

use Illuminate\Events\Dispatcher;
use OhDear\LaravelWebhooks\OhDearWebhookCall;

class OhDearWebhooksEventSubscriber
{
    private OhDearUptimeStore $ohDearUptimeStore;

    public function __construct(OhDearUptimeStore $ohDearUptimeStore)
    {
        $this->ohDearUptimeStore = $ohDearUptimeStore;
    }

    public function onUptimeCheckFailed(OhDearWebhookCall $ohDearWebhookCall)
    {
        $site = $ohDearWebhookCall->site();

        $this->ohDearUptimeStore->markSiteAsUp($site['url']);
    }

    public function onUptimeCheckRecovered(OhDearWebhookCall $ohDearWebhookCall)
    {
        $site = $ohDearWebhookCall->site();

        $this->ohDearUptimeStore->markSiteAsUp($site['url']);
    }

    public function subscribe(Dispatcher $events)
    {
        $events->listen(
            'ohdear-webhooks::uptimeCheckFailed',
            static::class . ':@onUptimeCheckFailed',
        );

        $events->listen(
            'ohdear-webhooks::uptimeCheckRecovered',
            static::class . ':@onUptimeCheckRecovered',
        );
    }
}
