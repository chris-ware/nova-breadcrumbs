<?php

namespace ChrisWare\NovaBreadcrumbs;

use Laravel\Nova\Nova;
use Laravel\Nova\Tool;

class NovaBreadcrumbs extends Tool
{
    protected $loadStyles = true;

    /**
     * Perform any tasks that need to happen when the tool is booted.
     *
     * @return void
     */
    public function boot()
    {
        Nova::script('nova-breadcrumbs-2020-06-16', __DIR__ . '/../dist/js/tool.js');
        if ($this->loadStyles) {
            Nova::style('nova-breadcrumbs-2020-06-16', __DIR__ . '/../dist/css/tool.css');
        }
    }

    /**
     * Build the view that renders the navigation links for the tool.
     */
    public function renderNavigation()
    {
        return false;
    }

    public function withoutStyles()
    {
        $this->loadStyles = false;

        return $this;
    }
}
