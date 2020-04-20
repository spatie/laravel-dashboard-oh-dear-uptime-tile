<?php

namespace Spatie\OhDearUptimeTile;

use App\Tiles\Uptime\OhDearUptimeStore;
use Illuminate\Events\Dispatcher;
use App\Events\Uptime\UptimeCheckFailed;
use App\Events\Uptime\UptimeCheckRecovered;
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
