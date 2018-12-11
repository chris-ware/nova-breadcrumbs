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
        \ChrisWare\NovaBreadcrumbs\NovaBreadcrumbs::make(),
    ];
}
```

Finally, add the Breadcrumbs trait to your App\Nova\Resource class.

```php
use ChrisWare\NovaBreadcrumbs\Traits\Breadcrumbs;

abstract class Resource extends NovaResource
{
    use Breadcrumbs;
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
        \ChrisWare\NovaBreadcrumbs\NovaBreadcrumbs::make()->withoutStyles(),
    ];
}
```

You can also customise both the label and title for a Resource. Label refers to the Resource's Name, so a Users Resource would have a Users label. Title refers to the title of the Resource as set by the $title property on the resource, so by default it would be the resource ID. Both of these can be overwritten for Breadcrumbs only by overwriting the functions on the trait that start with breadcrumb.

## Information

This package works on the following views:
- Dashboard
- Index
- Detail
- Create
- Update
- Attach
- UpdateAttached

The Index & Detail views make use of of the custom header components that are currently available in the core Laravel Nova views. There are 2 new custom Vue components that are introduced for extensibility, for both sets of views. They are custom-{view}-pre-breadcrumbs and custom-{view}-post-breadcrumbs, where {view} is either index or detail.

The remaining views are hooked via an overwrite to the routes, forcing them to use custom extended views. Once Laravel Nova enable these views to also have custom headers, the package will switch to these instead.
