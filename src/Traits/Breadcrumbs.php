<?php

namespace Morphsites\NovaBreadcrumbs\Traits;

use Illuminate\Support\Collection;

trait Breadcrumbs
{
    /**
     * Prepare the resource for JSON serialization using the given fields.
     *
     * @param  \Illuminate\Support\Collection $fields
     *
     * @return array
     */
    protected function serializeWithId(Collection $fields)
    {
        $parent = parent::serializeWithId($fields);

        return array_merge($parent, [
            'label' => $this->breadcrumbResourceLabel(),
            'title' => $this->breadcrumbResourceTitle(),
        ]);
    }

    protected function breadcrumbResourceLabel()
    {
        return $this->label();
    }

    protected function breadcrumbResourceTitle()
    {
        return $this->title();
    }
}
