<?php

use Spatie\OhDearUptimeTile\OhDearUptimeStore;

it('can mark a site as down', function () {
    $store = OhDearUptimeStore::make();

    $store->markSiteAsDown('https://example.com');

    expect($store->downSites())->toBe(['https://example.com']);
});

it('can mark a site as up', function () {
    $store = OhDearUptimeStore::make();

    $store->markSiteAsDown('https://example.com');
    $store->markSiteAsDown('https://spatie.be');
    $store->markSiteAsUp('https://example.com');

    expect($store->downSites())->toBe([1 => 'https://spatie.be']);
});

it('can clear all down sites', function () {
    $store = OhDearUptimeStore::make();

    $store->markSiteAsDown('https://example.com');
    $store->markSiteAsDown('https://spatie.be');
    $store->clearDownSites();

    expect($store->downSites())->toBe([]);
});

it('does not add duplicate down sites', function () {
    $store = OhDearUptimeStore::make();

    $store->markSiteAsDown('https://example.com');
    $store->markSiteAsDown('https://example.com');

    expect($store->downSites())->toBe(['https://example.com']);
});

it('can run the clear down sites command', function () {
    $store = OhDearUptimeStore::make();

    $store->markSiteAsDown('https://example.com');

    $this->artisan('dashboard:clear-oh-dear-down-sites')->assertSuccessful();

    expect($store->downSites())->toBe([]);
});
