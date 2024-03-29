<?php

namespace App\Http\Controllers\Transaction;

use App\Dao\Enums\RoleType;
use App\Dao\Enums\TicketContract;
use App\Dao\Enums\TicketPriority;
use App\Dao\Enums\TicketStatus;
use App\Dao\Models\Department;
use App\Dao\Models\Location;
use App\Dao\Models\Product;
use App\Dao\Models\Supplier;
use App\Dao\Models\TicketSystem;
use App\Dao\Models\TicketTopic;
use App\Dao\Models\User;
use App\Dao\Models\WorkType;
use App\Dao\Repositories\TicketSystemRepository;
use App\Http\Controllers\System\MasterController;
use App\Http\Requests\TicketSystemRequest;
use App\Http\Requests\TicketWorksheetRequest;
use App\Http\Services\CreateTicketService;
use App\Http\Services\SingleService;
use App\Http\Services\UpdateTicketService;
use App\Http\Services\UpdateTicketWorksheetService;
use Barryvdh\DomPDF\Facade as PDF;
use Coderello\SharedData\Facades\SharedData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Plugins\Query;
use Plugins\Response;
use Plugins\Template;

class TicketSystemController extends MasterController
{
    public function __construct(TicketSystemRepository $repository, SingleService $service)
    {
        self::$repository = self::$repository ?? $repository;
        self::$service = self::$service ?? $service;
    }

    private function getImplementor($model)
    {
        $implementor = $model
            ->where(User::field_role(), RoleType::Pelaksana)
            ->pluck(User::field_name(), User::field_primary());
        return $implementor;
    }

    private function getUser($user)
    {
        if (in_array(Query::getRole(auth()->user()->{User::field_role()}), [RoleType::User, RoleType::Pelaksana])) {
            $user = $user->where(User::field_primary(), auth()->user()
                    ->{User::field_primary()});
        }

        return $user->pluck(User::field_name(), User::field_primary());
    }

    protected function share($data = [])
    {
        $ticket_topic = TicketTopic::optionBuild();
        $department = Department::optionBuild();
        $type = WorkType::optionBuild();
        $user = User::optionBuild(true);
        $vendor = Supplier::optionBuild();
        $work_type = WorkType::optionBuild();

        $status = TicketStatus::getOptions();
        $priority = TicketPriority::getOptions();
        $contract = TicketContract::getOptions();

        $product = Query::getProduct();
        $location = Query::getLocation();

        $view = [
            'ticket_topic' => $ticket_topic,
            'department' => $department,
            'location' => $location,
            'implementor' => $this->getImplementor($user),
            'user' => $this->getUser($user),
            'model' => false,
            'status' => $status,
            'work_type' => $work_type,
            'type' => $type,
            'product' => $product,
            'priority' => $priority,
            'contract' => $contract,
            'vendor' => $vendor,
            'worksheet' => null,
        ];

        return self::$share = array_merge($view, $data, self::$share);
    }

    public function getCreate()
    {
        return view(Template::form(SharedData::get('template')))->with($this->share([
            'status' => TicketStatus::getOptions([TicketStatus::Open]),
        ]));
    }

    public function getUpdate($code)
    {
        $data = $this->get($code, ['has_worksheet', 'has_type', 'has_worksheet.has_vendor', 'has_worksheet.has_implementor']);
        $worksheet = false;
        if($data){
            $worksheet = $data->has_worksheet;
        }
        return view(Template::form(SharedData::get('template')))->with($this->share([
            'model' => $this->get($code),
            'worksheet' => $worksheet->sortBy('worksheet_created_at'),
        ]));
    }

    public function postCreate(TicketSystemRequest $request, CreateTicketService $service)
    {
        $data = $service->save(self::$repository, $request);
        return Response::redirectBack($data);
    }

    public function postUpdate($code, TicketSystemRequest $request, UpdateTicketService $service)
    {
        $data = $service->update(self::$repository, $request, $code);
        return Response::redirectBack($data, true);
    }

    public function postUpdateWorksheet($code, TicketWorksheetRequest $request, UpdateTicketWorksheetService $service)
    {
        $data = $service->update(self::$repository, $request, $code);
        return Response::redirectBack($data);
    }

    public function getPdf()
    {
        $implementor = false;
        $data = $this->get(request()->get('code'), [
            'has_ticket_topic',
            'has_department',
            'has_location',
            'has_reported',
        ])->first();

        if ($person = $data->field_implementor) {
            $implementor = User::whereIn(User::field_primary(), $person)->get();
        }

        $share = [
            'master' => $data,
            'implementor' => $implementor,
        ];

        $pdf = PDF::loadView(Template::print(SharedData::get('template')), $share);
        return $pdf->stream();
    }
}
