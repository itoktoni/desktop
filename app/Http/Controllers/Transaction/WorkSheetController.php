<?php

namespace App\Http\Controllers\Transaction;

use App\Dao\Enums\TicketStatus;
use App\Dao\Enums\WorkStatus;
use App\Dao\Models\Product;
use App\Dao\Models\TicketSystem;
use App\Dao\Models\User;
use App\Dao\Models\WorkType;
use App\Dao\Repositories\TicketSystemRepository;
use App\Dao\Repositories\WorkSheetRepository;
use App\Http\Controllers\System\MasterController;
use App\Http\Requests\WorkSheetRequest;
use App\Http\Services\CreateWorkSheetService;
use App\Http\Services\SingleService;
use App\Http\Services\UpdateService;
use Barryvdh\DomPDF\Facade as PDF;
use Coderello\SharedData\Facades\SharedData;
use Maatwebsite\Excel\Facades\Excel;
use Plugins\Response;
use Plugins\Template;
use Plugins\Views;

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
        $user = User::optionBuild();
        $status = WorkStatus::getOptions();
        $ticket = TicketSystem::optionBuild(true)
            ->where(TicketSystem::field_status(), '!=', TicketStatus::Close)->mapWithKeys(function ($item) {
            return [$item->{TicketSystem::field_primary()} => Views::uiiShort($item->{TicketSystem::field_primary()}) . ' - ' . $item->{TicketSystem::field_name()}];
        });

        $data_ticket = false;
        if (request()->has('ticket_id')) {
            $data_ticket = (new TicketSystemRepository())
                ->getTicketByCode(request()
                        ->get('ticket_id'));
        }

        self::$share = [
            'work_type' => $work_type,
            'product' => $product,
            'data_ticket' => $data_ticket,
            'ticket' => $ticket,
            'user' => $user,
            'status' => $status,
        ];
    }

    public function postCreate(WorkSheetRequest $request, CreateWorkSheetService $service)
    {
        $data = $service->save(self::$repository, $request);
        return Response::redirectBack($data);
    }

    public function postUpdate($code, WorkSheetRequest $request, UpdateService $service)
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
        return Excel::download(new WorkSheetRepository, 'Work_sheet.' . date('Ymd') . '.xlsx');
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
