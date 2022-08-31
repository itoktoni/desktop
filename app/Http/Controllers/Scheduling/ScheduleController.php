<?php

namespace App\Http\Controllers\Scheduling;

use App\Dao\Enums\ScheduleStatus;
use App\Dao\Models\Product;
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

    protected function share($data = [])
    {
        $status = ScheduleStatus::getOptions();
        $product = Product::optionBuild();

        $view = [
            'status' => $status,
            'product' => $product,
            'model' => false,
        ];

        return self::$share = array_merge($view, $data, self::$share);
    }

    public function postCreate(ScheduleRequest $request, CreateScheduleService $service)
    {
        $data = $service->save(self::$repository, $request);
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
