<?php

namespace App\Http\Controllers\Transaction;

use App\Dao\Enums\TicketStatus;
use App\Dao\Models\Department;
use App\Dao\Models\User;
use App\Dao\Enums\TicketPriority;
use App\Dao\Models\TicketTopic;
use App\Dao\Repositories\TicketSystemRepository;
use App\Http\Controllers\System\MasterController;
use App\Http\Requests\TicketSystemRequest;
use App\Http\Services\CreateTicketService;
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

    public function postCreate(TicketSystemRequest $request, CreateTicketService $service)
    {
        $data = $service->save(self::$repository, $request);
        return Response::redirectBack($data);
    }

    public function postUpdate($code, TicketSystemRequest $request, UpdateService $service)
    {
        $data = $service->update(self::$repository, $request, $code);
        return Response::redirectBack($data);
    }

    public function getPdf()
    {
        $data = [
            'master' => null,
        ];
        $pdf = PDF::loadView(Template::print(SharedData::get('template')), $data);
        return $pdf->stream();
    }
}
