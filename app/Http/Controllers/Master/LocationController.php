<?php

namespace App\Http\Controllers\Master;

use App\Dao\Enums\BooleanType;
use App\Dao\Models\Building;
use App\Dao\Repositories\LocationRepository;
use App\Http\Controllers\System\MasterController;
use App\Http\Requests\LocationRequest;
use App\Http\Services\CreateService;
use App\Http\Services\SingleService;
use App\Http\Services\UpdateService;
use Coderello\SharedData\Facades\SharedData;
use Plugins\Response;
use Plugins\Template;

class LocationController extends MasterController
{
    public function __construct(LocationRepository $repository, SingleService $service)
    {
        self::$repository = self::$repository ?? $repository;
        self::$service = self::$service ?? $service;
    }

    private function share($data = [])
    {
        $status = BooleanType::getOptions();
        $building = Building::optionBuild();
        $view = [
            'status' => $status,
            'building' => $building,
        ];
        return array_merge($view, $data);
    }

    public function postCreate(LocationRequest $request, CreateService $service)
    {
        $data = $service->save(self::$repository, $request);
        return Response::redirectBack($data);
    }

    public function postUpdate($code, LocationRequest $request, UpdateService $service)
    {
        $data = $service->update(self::$repository, $request, $code);
        return Response::redirectBack($data);
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
}
