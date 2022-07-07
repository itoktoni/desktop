<?php

namespace App\Http\Controllers\Master;

use App\Dao\Enums\BooleanType;
use App\Dao\Repositories\LocationRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\LocationRequest;
use App\Http\Services\CreateService;
use App\Http\Services\DeleteService;
use App\Http\Services\SingleService;
use App\Http\Services\UpdateService;
use Coderello\SharedData\Facades\SharedData;
use Plugins\Response;
use Plugins\Template;

class LocationController extends Controller
{
    public static $service;
    public static $repository;

    public function __construct(LocationRepository $repository, SingleService $service)
    {
        self::$repository = self::$repository ?? $repository;
        self::$service = self::$service ?? $service;
    }
    
    private function share($data = [])
    {
        $status = BooleanType::getOptions();
        $view = [
            'status' => $status,
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
        return view(Template::table(SharedData::get('template')))->with($this->share([
            'data' => $data,
            'fields' => self::$repository->model->getShowField(),
        ]));
    }

    public function getCreate()
    {
        return view(Template::form(SharedData::get('template')))->with($this->share());
    }

    public function postCreate(LocationRequest $request, CreateService $service)
    {
        $data = $service->save(self::$repository, $request);
        return Response::redirectBack($data);
    }

    public function getUpdate($code)
    {
        return view(Template::form(SharedData::get('template')))->with($this->share([
            'model' => $this->get($code),
        ]));
    }

    public function postUpdate($code, LocationRequest $request, UpdateService $service)
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

    public function postDelete(LocationRequest $request, DeleteService $service)
    {
        $code = $request->get('code');
        $data = $service->delete(self::$repository, $code);
        return Response::redirectBack($data);
    }
}
