<?php

namespace App\Http\Controllers\Master;

use App\Dao\Repositories\SupplierRepository;
use App\Http\Controllers\System\MasterController;
use App\Http\Requests\SupplierRequest;
use App\Http\Services\CreateService;
use App\Http\Services\SingleService;
use App\Http\Services\UpdateService;
use Plugins\Response;

class SupplierController extends MasterController
{
    public function __construct(SupplierRepository $repository, SingleService $service)
    {
        self::$repository = self::$repository ?? $repository;
        self::$service = self::$service ?? $service;
    }

    public function postCreate(SupplierRequest $request, CreateService $service)
    {
        $data = $service->save(self::$repository, $request);
        return Response::redirectBack($data);
    }

    public function postUpdate($code, SupplierRequest $request, UpdateService $service)
    {
        $data = $service->update(self::$repository, $request, $code);
        return Response::redirectBack($data);
    }
}