<?php

namespace App\Http\Controllers\Transaction;

use App\Dao\Enums\MovementStatus;
use App\Dao\Models\Location;
use App\Dao\Models\Product;
use App\Dao\Repositories\MovementRepository;
use App\Http\Controllers\System\MasterController;
use App\Http\Requests\MovementRequest;
use App\Http\Services\CreateService;
use App\Http\Services\SingleService;
use App\Http\Services\UpdateService;
use Barryvdh\DomPDF\Facade as PDF;
use Coderello\SharedData\Facades\SharedData;
use Maatwebsite\Excel\Facades\Excel;
use Plugins\Response;
use Plugins\Template;

class MovementController extends MasterController
{
    public function __construct(MovementRepository $repository, SingleService $service)
    {
        self::$repository = self::$repository ?? $repository;
        self::$service = self::$service ?? $service;
    }

    protected function beforeForm()
    {
        $status = MovementStatus::getOptions();
        $product = Product::optionBuild();
        $location = Location::optionBuild();
        self::$share = [
            'status' => $status,
            'product' => $product,
            'location' => $location,
        ];
    }

    public function staticForm()
    {
        if (true) {
            $text = "readonly disabled";
        }
        return $text;
    }

    public function postCreate(MovementRequest $request, CreateService $service)
    {
        $data = $service->save(self::$repository, $request);
        return Response::redirectBack($data);
    }

    public function postUpdate($code, MovementRequest $request, UpdateService $service)
    {
        $data = $service->update(self::$repository, $request, $code);
        return Response::redirectBack($data);
    }

    public function getPrint()
    {
        $query = self::$repository->setDisablePaginate()->dataRepository();
        return view(Template::print(SharedData::get('template')))->with($this->share([
            'data' => $query->get(),
            'fields' => self::$repository->model->getShowField(),
        ]));
    }

    public function getExcel()
    {
        return Excel::download(new MovementRepository, 'Work_sheet.' . date('Ymd') . '.xlsx');
    }

    public function getCsv()
    {
        return self::$repository->excel('Work_sheet.' . date('Ymd'));
    }

    public function getPdf()
    {
        // $dompdf=PDF::getDomPDF();
        // $dompdf->loadHTML('<h1>Test</h1>');
        // $dompdf->render();
        // $dompdf->get_canvas()->get_cpdf()->setEncryption("userpass", "adminpass");
        // return $dompdf->stream();

        return PDF::loadHTML('<h1>Test</h1>')->stream();
    }
}
