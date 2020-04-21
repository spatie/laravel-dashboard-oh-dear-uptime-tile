# A tile to display sites that are down

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/laravel-dashboard-oh-dear-uptime-tile.svg?style=flat-square)](https://packagist.org/packages/spatie/:package_name)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/spatie/laravel-dashboard-oh-dear-uptime-tile/run-tests?label=tests)](https://github.com/spatie/:package_name/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/laravel-dashboard-oh-dear-uptime-tile.svg?style=flat-square)](https://packagist.org/packages/spatie/:package_name)

This tile can used on the [Laravel Dashboard](https://github.com/spatie/laravel-dashboard) to display the sites that [Oh Dear](https://ohdear.app) detects as down.

![screenshot](TODO: add link)

## Support us

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us). 

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require spatie/laravel-dashboard-oh-dear-tile
```

This package listens for event coming from Oh Dear using the `ohdearapp/laravel-ohdear-webhooks` package. Before you can use this tie, you most for set up `laravel-ohdear-webhooks`. You'll find instructions at [in this section in the Oh Dear docs](https://ohdear.app/docs/integrations/webhooks/laravel-package).

## Usage

In your dashboard view you use the `livewire:calendar-tile` component. You should pass the calendar id for your calendar to the `calendar-id` property.

```html
<x-dashboard>
    <livewire:oh-daer-uptime-tile position="a1:a3" />
</x-dashboard>
```

### Customizing the view

If you want to customize the view used to render this tile, run this command:

```bash
php artisan vendor:publish --provider="Spatie\OhDearUptimeTile\OhDearUptimeTileServiceProvider" --tag="dashboard-oh-dear-uptime-tile-views"
```

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email freek@spatie.be instead of using the issue tracker.

## Credits

- [Freek Van der Herten](https://github.com/freekmurze)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
