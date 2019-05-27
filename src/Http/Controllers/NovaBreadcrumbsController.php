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
        $view = Str::after($request->get('view'), 'custom-');
        $novaHome = Str::finish($request->get('location')['origin'] . Nova::path(), '/');
        $path = Str::after($request->get('location')['href'], $novaHome);
        $pathParts = collect(explode('/', $path))->filter();
        $this->appendToCrumbs(__('Home'), $novaHome);

        if ($pathParts->has(1)) {
            $this->resource = Nova::resourceForKey($pathParts->get(1));
            
            if (!$this->resource::breadcrumbs()) {
                return null;
            }
            
            $this->appendToCrumbs($this->resource::breadcrumbResourceLabel(), $novaHome . $pathParts->slice(0, 2)->implode('/'));
        }

        if ($pathParts->has(2)) {
            $this->resource = Nova::resourceForKey($pathParts->get(1));
            $this->model = $this->findResourceOrFail($pathParts->get(2));

            $this->appendToCrumbs($this->model->breadcrumbResourceTitle(), $novaHome . $pathParts->slice(0, 3)->implode('/'));
        }

        if ($pathParts->has(3)) {
            $this->appendToCrumbs(__(Str::ucfirst($view)), $novaHome . $pathParts->slice(0, 4)->implode('/'));
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
    public function resource()
    {
        return tap($this->resource, function ($resource) {
            abort_if(is_null($resource), 404);
        });
    }
}
