<?php

namespace App\Http\Controllers\Report;

use App\Dao\Enums\WorkStatus;
use App\Dao\Models\Department;
use App\Dao\Models\Product;
use App\Dao\Models\User;
use App\Dao\Models\WorkType;
use App\Dao\Repositories\WorkSheetRepository;
use App\Http\Controllers\System\MasterController;
use Barryvdh\DomPDF\Facade as PDF;
use Coderello\SharedData\Facades\SharedData;
use Plugins\Template;
use Maatwebsite\Excel\Facades\Excel;

class ReportWorkSheetController extends MasterController
{
    public function __construct(WorkSheetRepository $repository)
    {
        self::$repository = self::$repository ?? $repository;
    }

    protected function beforeForm()
    {
        $department = Department::optionBuild();
        $user = User::optionBuild();
        $work_type = WorkType::optionBuild();
        $product = Product::optionBuild();
        $user = User::optionBuild();
        $status = WorkStatus::getOptions();

        self::$share = [
            'department' => $department,
            'work_type' => $work_type,
            'product' => $product,
            'user' => $user,
            'status' => $status,
        ];
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
        return Excel::download(new WorkSheetRepository, 'work_sheet.'.date('Ymd').'.xlsx');
    }

    public function getCsv()
    {
        return self::$repository->excel('work_sheet.'.date('Ymd'));
    }
}
