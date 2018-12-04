# Nova Breadcrumbs
Breadcrumbs for Laravel Nova

[![Latest Stable Version](https://badgen.net/packagist/v/chris-ware/nova-breadcrumbs)](https://packagist.org/packages/chris-ware/nova-breadcrumbs)
[![Total Downloads](https://badgen.net/packagist/dt/chris-ware/nova-breadcrumbs)](ttps://packagist.org/packages/chris-ware/nova-breadcrumbs)
[![License](https://badgen.net/packagist/license/chris-ware/nova-breadcrumbs)](ttps://packagist.org/packages/chris-ware/nova-breadcrumbs)
[![StyleCI](https://github.styleci.io/repos/160367785/shield?branch=master)](https://github.styleci.io/repos/160367785)

**IMPORTANT**  
This is a work-in-progress package and is liable to change. Advised not to use in production environments unless you know what you are doing and have complete faith in the code working.

 ## Installation

You can install the package in to a Laravel app that uses [Nova](https://nova.laravel.com) via composer:

```bash
composer require chris-ware/nova-breadcrumbs
```

Next, you must register the tool with Nova. This is typically done in the `tools` method of the `NovaServiceProvider`.

```php
// in app/Providers/NovaServiceProvder.php

// ...
public function tools()
{
    return [
        // ...
        \ChrisWare\NovaBreadcrumbs\NovaBreadcrumbs()::make,
    ];
}
```

## Customisation

You can disable the bundled styles and load your own by adding the following method to the call:

```php
// in app/Providers/NovaServiceProvder.php

// ...
public function tools()
{
    return [
        // ...
        \ChrisWare\NovaBreadcrumbs\NovaBreadcrumbs()::make()->withoutStyles(),
    ];
}
```
## Information

This package only works on the index and detail pages currently, as these are the onyl Vue components that have customisable headers. The detail page only shows a link name of Detail, although the intention is to replace this with the Resource name in given time.

There are 2 new custom Vue components that are introduced for extensibility, for both sets of views. They are custom-{view}-pre-breadcrumbs and custom-{view}-post-breadcrumbs, where view is either index or detail.
