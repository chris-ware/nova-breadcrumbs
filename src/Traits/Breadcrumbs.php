<?php

namespace ChrisWare\NovaBreadcrumbs\Traits;

use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ID;

trait Breadcrumbs
{
    /**
     * Prepare the resource for JSON serialization using the given fields.
     *
     * @param  \Illuminate\Support\Collection  $fields
     * @return array
     */
    protected function serializeWithId(Collection $fields)
    {
        $parent = parent::serializeWithId($fields);

        return array_merge($parent, [
            'title' => $this->title(),
        ]);
    }

}
