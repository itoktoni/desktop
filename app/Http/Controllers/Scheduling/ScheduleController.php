<?php

namespace App\Http\Controllers\Scheduling;

use App\Dao\Enums\ScheduleEvery;
use App\Dao\Enums\ScheduleStatus;
use App\Dao\Enums\ScheduleType;
use App\Dao\Models\Location;
use App\Dao\Models\Product;
use App\Dao\Models\WorkType;
use App\Dao\Repositories\ScheduleRepository;
use App\Http\Controllers\System\MasterController;
use App\Http\Requests\ScheduleRequest;
use App\Http\Services\CreateScheduleService;
use App\Http\Services\SingleService;
use App\Http\Services\UpdateScheduleService;
use Barryvdh\DomPDF\Facade as PDF;
use Coderello\SharedData\Facades\SharedData;
use Plugins\Response;
use Plugins\Template;

class ScheduleController extends MasterController
{
    public function __construct(ScheduleRepository $repository, SingleService $service)
    {
        self::$repository = self::$repository ?? $repository;
        self::$service = self::$service ?? $service;
    }

    private function getProduct()
    {
        $product = Product::with(['has_location'])->get()
            ->mapWithKeys(function ($item) {
                $name = $item->has_location->field_name . ' - ' . $item->field_name;
                $id = $item->field_primary . '';
                return [$id => $name];
            });

        return $product;
    }

    private function getLocation()
    {
        $location = Location::with(['has_building'])->get()
            ->mapWithKeys(function ($item) {
                $name = $item->has_building->field_name . ' - ' . $item->field_name;
                $id = $item->field_primary . '';
                return [$id => $name];
            });

        return $location;
    }

    protected function share($data = [])
    {
        $status = WorkType::optionBuild();
        $type = ScheduleEvery::getOptions();
        $product = $this->getProduct();
        $location = $this->getLocation();

        $view = [
            'status' => $status,
            'location' => $location,
            'product' => $product,
            'every' => $type,
            'model' => false,
        ];

        return self::$share = array_merge($view, $data, self::$share);
    }

    public function postCreate(ScheduleRequest $request, CreateScheduleService $service)
    {
        $data = $service->save(self::$repository, $request);
        dd($data);
        return Response::redirectBack($data);
    }

    public function postUpdate($code, ScheduleRequest $request, UpdateScheduleService $service)
    {
        $data = $service->update(self::$repository, $request, $code);
        return Response::redirectBack($data);
    }

    public function getPrint()
    {
        $data = $this->get(request()->get('code'), [
            'has_product',
        ]);

        $share = [
            'master' => $data,
        ];

        $pdf = PDF::loadView(Template::print(SharedData::get('template')), $share);
        return $pdf->stream();
    }
}
