<?php

namespace App\Http\Controllers\Master;

use App\Dao\Models\Location;
use App\Dao\Repositories\SparepartRepository;
use App\Http\Requests\SparepartRequest;
use App\Http\Services\CreateService;
use App\Http\Services\SingleService;
use App\Http\Services\UpdateService;
use Plugins\Response;
use App\Http\Controllers\System\MasterController;

class SparepartController extends MasterController
{
    public function __construct(SparepartRepository $repository, SingleService $service)
    {
        self::$repository = self::$repository ?? $repository;
        self::$service = self::$service ?? $service;
    }

    protected function beforeForm()
    {
        $location = Location::optionBuild();
        self::$share = [
            'location' => $location,
        ];
    }

    public function postCreate(SparepartRequest $request, CreateService $service)
    {
        $data = $service->save(self::$repository, $request);
        return Response::redirectBack($data);
    }

    public function postUpdate($code, SparepartRequest $request, UpdateService $service)
    {
        $data = $service->update(self::$repository, $request, $code);
        return Response::redirectBack($data);
    }
}
