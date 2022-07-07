<?php

namespace App\Http\Controllers\System;

use App\Dao\Enums\BooleanType;
use App\Dao\Repositories\RoutesRepository;
use App\DatabaseJson\Models\Routes;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoutesRequest;
use App\Http\Services\CreateRoutesService;
use App\Http\Services\CreateService;
use App\Http\Services\DeleteService;
use App\Http\Services\SingleService;
use App\Http\Services\UpdateRoutesService;
use App\Http\Services\UpdateService;
use Coderello\SharedData\Facades\SharedData;
use Plugins\Response;
use Plugins\Template;

class RoutesController extends Controller
{
    public static $service;
    public static $repository;
    public static $template;

    public function __construct(RoutesRepository $repository, SingleService $service)
    {
        self::$repository = self::$repository ?? $repository;
        self::$service = self::$service ?? $service;
        self::$template = 'routes';
    }

    private function share($data = [])
    {
        $status = BooleanType::getOptions();
        $view = [
            'status' => $status,
            'template' => self::$template,
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
            'model' => new Routes()
        ]));
    }

    public function getCreate()
    {
        return view(Template::form(self::$template))->with($this->share());
    }

    public function postCreate(RoutesRequest $request, CreateRoutesService $service)
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

    public function postUpdate($code, RoutesRequest $request, UpdateRoutesService $service)
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

    public function postDelete(RoutesRequest $request, DeleteService $service)
    {
        $code = $request->get('code');
        $data = $service->delete(self::$repository, $code);
        return Response::redirectBack($data);
    }
}
