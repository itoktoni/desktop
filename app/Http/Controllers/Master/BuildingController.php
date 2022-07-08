<?php

namespace App\Http\Controllers\Master;

use App\Dao\Repositories\BuildingRepository;
use App\Http\Requests\BuildingRequest;
use App\Http\Services\CreateService;
use App\Http\Services\SingleService;
use App\Http\Services\UpdateService;
use Plugins\Response;

class BuildingController extends MasterController
{
    public function __construct(BuildingRepository $repository, SingleService $service)
    {
        self::$repository = self::$repository ?? $repository;
        self::$service = self::$service ?? $service;
        self::$template = 'building';
    }

    public function postCreate(BuildingRequest $request, CreateService $service)
    {
        $data = $service->save(self::$repository, $request);
        return Response::redirectBack($data);
    }

    public function postUpdate($code, BuildingRequest $request, UpdateService $service)
    {
        $data = $service->update(self::$repository, $request, $code);
        return Response::redirectBack($data);
    }
}
