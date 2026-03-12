<?php

namespace Spatie\OhDearUptimeTile\Tests;

use Illuminate\Support\Facades\Schema;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\Dashboard\DashboardServiceProvider;
use Spatie\OhDearUptimeTile\OhDearUptimeTileServiceProvider;

abstract class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase();
    }

    protected function getPackageProviders($app): array
    {
        return [
            LivewireServiceProvider::class,
            DashboardServiceProvider::class,
            OhDearUptimeTileServiceProvider::class,
        ];
    }

    protected function defineEnvironment($app): void
    {
        $app['config']->set('app.key', 'base64:'.base64_encode(random_bytes(32)));
    }

    protected function setUpDatabase(): void
    {
        Schema::dropIfExists('dashboard_tiles');

        $migrationFile = dirname(__DIR__).'/vendor/spatie/laravel-dashboard/database/migrations/create_dashboard_tiles_table.php.stub';

        $migration = include $migrationFile;
        $migration->up();
    }
}
