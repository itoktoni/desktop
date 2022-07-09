<?php

namespace App\Http\Controllers\System;

use App\Dao\Enums\BooleanType;
use App\Dao\Models\Groups;
use App\Dao\Repositories\RoutesRepository;
use App\Http\Requests\RoutesRequest;
use App\Http\Requests\SortRequest;
use App\Http\Services\CreateRoutesService;
use App\Http\Services\SingleService;
use App\Http\Services\UpdateRoutesService;
use Coderello\SharedData\Facades\SharedData;
use Illuminate\Http\Request;
use Plugins\Response;
use Plugins\Template;

class RoutesController extends MasterController
{
    public function __construct(RoutesRepository $repository, SingleService $service)
    {
        self::$repository = self::$repository ?? $repository;
        self::$service = self::$service ?? $service;
    }

    private function share($data = [])
    {
        $status = BooleanType::getOptions();
        $data_groups = Groups::optionBuild();
        $view = [
            'status' => $status,
            'data_groups' => $data_groups,
        ];
        return array_merge($view, $data);
    }

    public function getCreate()
    {
        return view(Template::form(SharedData::get('template')))->with($this->share());
    }

    public function getUpdate($code)
    {
        return view(Template::form(SharedData::get('template')))->with($this->share([
            'model' => $this->get($code),
        ]));
    }

    public function postCreate(RoutesRequest $request, CreateRoutesService $service)
    {
        $data = $service->save(self::$repository, $request);
        return Response::redirectBack($data);
    }

    public function postUpdate($code, RoutesRequest $request, UpdateRoutesService $service)
    {
        $data = $service->update(self::$repository, $request, $code);
        return Response::redirectBack($data);
    }

    public function postSort(SortRequest $request, UpdateRoutesService $service){

        $data = $service->sort($request);
        return Response::redirectBack($data);
    }
}
