<?php

namespace ChrisWare\NovaBreadcrumbs\Traits;

use Illuminate\Support\Collection;

trait Breadcrumbs
{
    public static function breadcrumbs()
    {
        return true;
    }

    /**
     * @return boolean|string The label of the resource to be shown in the breadcrumbs.
     *                        If false, the resource will not be displayed
     */
    public static function breadcrumbResourceLabel()
    {
        return static::label();
    }

    /**
     * @return boolean|string The title of the resource to be shown in the breadcrumbs.
     *                        If false, the resource will not be displayed
     */
    public function breadcrumbResourceTitle()
    {
        return $this->title();
    }

    /**
     * @return boolean|array Additional breadcrumbs to be shown. Should be defined as
     *                       an array of ['label' => string, 'url' => string].
     *                       If false, no additional items are going to be displayed
     */
    public function customBreadcrumbs()
    {
        return false;
    }

}
