<?php

namespace ChrisWare\NovaBreadcrumbs\Http\Controllers;

use ChrisWare\NovaBreadcrumbs\Traits\Breadcrumbs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Laravel\Nova\Http\Requests\InteractsWithLenses;
use Laravel\Nova\Http\Requests\InteractsWithResources;
use Laravel\Nova\Nova;

class NovaBreadcrumbsController extends Controller
{
    protected $resource;
    protected $model;
    protected $crumbs;

    use InteractsWithResources, InteractsWithLenses;

    public function __invoke(Request $request)
    {
        $this->crumbs = new Collection();

        $view = Str::of($request->get('view'))->replace('-', ' ')->after('custom-');

        $pathParts = Str::of($request->input('location.href'))
            ->after(Str::of($request->input('location.origin'))->append(Nova::path())->finish('/'))
            ->before('?')
            ->explode('/')
            ->filter();

        $this->appendToCrumbs(__('Home'), '/');

        if ($request->has('query') && ($query = collect($request->get('query'))->filter()) && $query->count() > 1) {
            $cloneParts = clone $pathParts;

            if ($query->has('viaResource')) {
                $cloneParts->put(1, $query->get('viaResource'));
            }
            if ($query->has('viaResourceId')) {
                $cloneParts->put(2, $query->get('viaResourceId'));
                $this->resource = $this->resourceFromKey($query->get('viaResource'));
            }

            if (empty($this->resource) == false) {
                $this->model = $this->findResourceOrFail($query->get('viaResourceId'));
                $this->appendToCrumbs($this->resource::breadcrumbResourceLabel(),
                    $cloneParts->slice(0, 2)->implode('/'));
                $this->appendToCrumbs($this->model->breadcrumbResourceTitle(),
                    $cloneParts->slice(0, 3)->implode('/'));
            }
        }

        if ($pathParts->has(1) == false) {
            return null;
        }

        $this->resource = $this->resourceFromKey($pathParts->get(1));

        if ($this->resource) {
            $this->appendToCrumbs($this->resource::breadcrumbResourceLabel(),
                $pathParts->slice(0, 2)->implode('/'));
        }

        if ($view == 'create') {
            $this->appendToCrumbs(Str::title($view), $pathParts->slice(0, 3)->implode('/'));
        } elseif ($view == 'dashboard.custom' && count(Nova::availableDashboards($request)) >= 1) {
            $this->appendToCrumbs(Str::title($request->get('name')), $pathParts->slice(0, 3)->implode('/'));
        } elseif ($view == 'lens') {
            $lens = Str::title(str_replace('-', ' ', $pathParts->get(3)));
            $this->appendToCrumbs($lens, $pathParts->slice(0, 4)->implode('/'));
        } elseif ($pathParts->has(2)) {
            $this->resource = Nova::resourceForKey($pathParts->get(1));
            $this->model = $this->findResourceOrFail($pathParts->get(2));
            if (method_exists($this->model, 'breadcrumbResourceTitle')) {
                $this->appendToCrumbs($this->model->breadcrumbResourceTitle(),
                    $pathParts->slice(0, 3)->implode('/'));
            }
        }

        if ($pathParts->has(3) && $view != 'lens') {
            $this->appendToCrumbs(Str::title($view),
                $pathParts->slice(0, 4)->implode('/'));
        }

        return $this->getCrumbs();
    }

    protected function appendToCrumbs($title, $url = null)
    {
        $this->crumbs->push([
            'title' => __($title),
            'path' => Str::start($url, '/'),
        ]);
    }

    /**
     * @return Collection
     */
    public function getCrumbs(): Collection
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
    public function resource()
    {
        return tap($this->resource, function ($resource) {
            abort_if(is_null($resource), 404);
        });
    }

    protected function resourceFromKey($key)
    {
        $resource = Nova::resourceForKey($key);
        if ($resource && in_array(Breadcrumbs::class, class_uses_recursive($resource)) == false) {
            return null;
        }

        if ($resource && method_exists($resource, 'breadcrumbs') == false) {
            return null;
        }

        if ($resource && $resource::breadcrumbs() == false) {
            return null;
        }

        return $resource;
    }
}
