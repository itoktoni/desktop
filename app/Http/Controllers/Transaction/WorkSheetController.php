<?php

namespace App\Http\Controllers\Transaction;

use App\Dao\Models\Product;
use App\Dao\Models\User;
use App\Dao\Models\WorkSheet;
use App\Dao\Models\WorkType;
use App\Dao\Repositories\WorkSheetRepository;
use App\Http\Controllers\System\MasterController;
use App\Http\Requests\WorkSheetRequest;
use App\Http\Services\CreateService;
use App\Http\Services\SingleService;
use App\Http\Services\UpdateService;
use Coderello\SharedData\Facades\SharedData;
use Illuminate\Support\Facades\Storage;
use Plugins\Response;
use Plugins\Template;
use Rap2hpoutre\FastExcel\FastExcel;
use Spatie\SimpleExcel\SimpleExcelWriter;
use Nikazooz\Simplesheet\Facades\Simplesheet;
use OpenSpout\Common\Entity\Cell;
use OpenSpout\Common\Entity\Row;

class WorkSheetController extends MasterController
{
    public function __construct(WorkSheetRepository $repository, SingleService $service)
    {
        self::$repository = self::$repository ?? $repository;
        self::$service = self::$service ?? $service;
    }

    protected function beforeForm()
    {
        $work_type = WorkType::optionBuild();
        $product = Product::optionBuild();
        self::$share = [
            'work_type' => $work_type,
            'product' => $product,
        ];
    }

    public function postCreate(WorkSheetRequest $request, CreateService $service)
    {
        $data = $service->save(self::$repository, $request);
        return Response::redirectBack($data);
    }

    public function postUpdate($code, WorkSheetRequest $request, UpdateService $service)
    {
        $data = $service->update(self::$repository, $request, $code);
        return Response::redirectBack($data);
    }

    public function getPrint(){
        $query = self::$repository->setDisablePaginate()->dataRepository();
        return view(Template::print(SharedData::get('template')))->with($this->share([
            'data' => $query->get(),
            'fields' => self::$repository->model->getShowField(),
        ]));
    }

    public function getExcel()
    {
        return self::$repository->excel('Work_sheet.'.date('Ymd'));
    }
}
