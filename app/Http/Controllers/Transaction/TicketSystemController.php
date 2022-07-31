<?php

namespace App\Http\Controllers\Transaction;

use App\Dao\Enums\TicketStatus;
use App\Dao\Models\Department;
use App\Dao\Models\User;
use App\Dao\Models\TicketSystem;
use App\Dao\Enums\TicketPriority;
use App\Dao\Models\TicketTopic;
use App\Dao\Repositories\TicketSystemRepository;
use App\Exports\UsersExport;
use App\Http\Controllers\System\MasterController;
use App\Http\Requests\TicketSystemRequest;
use App\Http\Services\CreateService;
use App\Http\Services\SingleService;
use App\Http\Services\UpdateService;
use Barryvdh\DomPDF\Facade as PDF;
use Coderello\SharedData\Facades\SharedData;
use Plugins\Response;
use Plugins\Template;
use Maatwebsite\Excel\Facades\Excel;

class TicketSystemController extends MasterController
{
    public function __construct(TicketSystemRepository $repository, SingleService $service)
    {
        self::$repository = self::$repository ?? $repository;
        self::$service = self::$service ?? $service;
    }

    protected function beforeForm()
    {
        $ticket_topic = TicketTopic::optionBuild();
        $department = Department::optionBuild();
        $user = User::optionBuild();
        $status = TicketStatus::getOptions();
        $priority = TicketPriority::getOptions();

        self::$share = [
            'ticket_topic' => $ticket_topic,
            'department' => $department,
            'user' => $user,
            'status' => $status,
            'priority' => $priority,
        ];
    }

    public function postCreate(TicketSystemRequest $request, CreateService $service)
    {
        $data = $service->save(self::$repository, $request);
        return Response::redirectBack($data);
    }

    public function postUpdate($code, TicketSystemRequest $request, UpdateService $service)
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
        return Excel::download(new TicketSystemRepository, 'ticket_system.'.date('Ymd').'.xlsx');
    }

    public function getCsv()
    {
        return self::$repository->excel('ticket_system.'.date('Ymd'));
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
