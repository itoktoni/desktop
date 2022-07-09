<?php

namespace App\Http\Controllers\Master;

use App\Dao\Repositories\SparepartRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\SparepartRequest;
use App\Http\Services\CreateService;
use App\Http\Services\DeleteService;
use App\Http\Services\SingleService;
use App\Http\Services\UpdateService;
use Plugins\Response;
use Plugins\Template;

class SparepartController extends Controller
{
    public static $template;
    public static $service;
    public static $repository;

    public function __construct(SparepartRepository $repository, SingleService $service)
    {
        self::$repository = self::$repository ?? $repository;
        self::$service = self::$service ?? $service;
        self::$template = 'sparepart';
    }

    private function share($data = [])
    {
        $view = [
            // 'template' => self::$template,
        ];
        return array_merge($view, $data);
    }

    public function getData()
    {
        $query = self::$repository->dataRepository();
        return $query;
    }

    public function getTable()
    {
        $data = $this->getData();
        return view(Template::table(self::$template))->with($this->share([
            'data' => $data,
            'fields' => self::$repository->model->getShowField(),
        ]));
    }

    public function getCreate()
    {
        return view(Template::form(self::$template))->with($this->share());
    }

    public function postCreate(SparepartRequest $request, CreateService $service)
    {
        $data = $service->save(self::$repository, $request);
        return Response::redirectBack($data);
    }

    public function getUpdate($code)
    {
        return view(Template::form(self::$template))->with($this->share([
            'model' => $this->get($code),
        ]));
    }

    public function postUpdate($code, SparepartRequest $request, UpdateService $service)
    {
        $data = $service->update(self::$repository, $request, $code);
        return Response::redirectBack($data);
    }

    public function get($code = null, $relation = null)
    {
        $relation = $relation ?? request()->get('relation');
        if ($relation) {
            return self::$service->get(self::$repository, $code, $relation);
        }
        return self::$service->get(self::$repository, $code);
    }

    public function postDelete(SparepartRequest $request, DeleteService $service)
    {
        $code = $request->get('code');
        $data = $service->delete(self::$repository, $code);
        return Response::redirectBack($data);
    }
}
