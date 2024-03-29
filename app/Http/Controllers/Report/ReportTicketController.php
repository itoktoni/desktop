<?php

namespace App\Http\Controllers\Report;

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

class ReportTicketController extends MasterController
{
    public function __construct(TicketSystemRepository $repository)
    {
        self::$repository = self::$repository ?? $repository;
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
}
