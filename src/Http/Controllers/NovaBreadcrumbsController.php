<?php

namespace ChrisWare\NovaBreadcrumbs\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Laravel\Nova\Http\Requests\InteractsWithResources;
use Laravel\Nova\Nova;

class NovaBreadcrumbsController extends Controller
{

    protected $resource;
    protected $model;
    protected $crumbs;

    use InteractsWithResources;

    public function __construct()
    {
        $this->crumbs = new Collection();
    }

    public function __invoke(Request $request) {
        $view = str_replace('-',  ' ', Str::after($request->get('view'), 'custom-'));
        $novaHome = Str::finish($request->get('location')['origin'] . Nova::path(), '/');
        $path = Str::after($request->get('location')['href'], $novaHome);
        $pathParts = collect(explode('/', $path))->filter();
        $this->appendToCrumbs(__('Home'), $novaHome);

        if ($request->has('query')) {
            $query = collect($request->get('query'))->filter();

            if ($query->count() > 1) {
                $cloneParts = clone $pathParts;
                $cloneParts->put(1, $query->get('viaResource'));
                $cloneParts->put(2, $query->get('viaResourceId'));
                $this->resource = Nova::resourceForKey($query->get('viaResource'));
                $this->model = $this->findResourceOrFail($query->get('viaResourceId'));
                $this->appendToCrumbs($this->resource::breadcrumbResourceLabel(), $novaHome . $cloneParts->slice(0, 2)->implode('/'));
                $this->appendToCrumbs($this->model->breadcrumbResourceTitle(), $novaHome . $cloneParts->slice(0, 3)->implode('/'));
            }

        }

        if ($pathParts->has(1)) {
            $this->resource = Nova::resourceForKey($pathParts->get(1));
            
            if (!$this->resource::breadcrumbs()) {
                return null;
            }
            
            $this->appendToCrumbs($this->resource::breadcrumbResourceLabel(), $novaHome . $pathParts->slice(0, 2)->implode('/'));
        }

        if ($view == 'create') {
            $this->appendToCrumbs(__(Str::title($view)), $novaHome . $pathParts->slice(0, 3)->implode('/'));
        } elseif ($pathParts->has(2)) {
            $this->resource = Nova::resourceForKey($pathParts->get(1));
            $this->model = $this->findResourceOrFail($pathParts->get(2));

            $this->appendToCrumbs($this->model->breadcrumbResourceTitle(), $novaHome . $pathParts->slice(0, 3)->implode('/'));
        }

        if ($pathParts->has(3)) {
            $this->appendToCrumbs(__(Str::title($view)), $novaHome . $pathParts->slice(0, 4)->implode('/'));
        }

        return $this->getCrumbs();
    }

    protected function appendToCrumbs($title, $url = null) {
        $this->crumbs->push([
            'title' => $title,
            'path' => $url
        ]);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getCrumbs(): \Illuminate\Support\Collection
    {
        $last = $this->crumbs->pop();
        $last['path'] = null;
        $this->crumbs->push($last);

        return $this->crumbs;
    }

    /**
     * Get the class name of the resource being requested.
     *
     * @return mixed
     */
    public function resource($resource = null)
    {
        return tap($this->resource, function ($resource) {
            abort_if(is_null($resource), 404);
        });
    }
}
