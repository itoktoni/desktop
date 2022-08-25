<?php

namespace App\Http\Controllers\Transaction;

use App\Dao\Enums\RoleType;
use App\Dao\Enums\TicketPriority;
use App\Dao\Enums\TicketStatus;
use App\Dao\Models\Department;
use App\Dao\Models\Location;
use App\Dao\Models\TicketTopic;
use App\Dao\Models\User;
use App\Dao\Repositories\TicketSystemRepository;
use App\Http\Controllers\System\MasterController;
use App\Http\Requests\TicketSystemRequest;
use App\Http\Services\CreateTicketService;
use App\Http\Services\SingleService;
use App\Http\Services\UpdateService;
use App\Http\Services\UpdateTicketService;
use Barryvdh\DomPDF\Facade as PDF;
use Coderello\SharedData\Facades\SharedData;
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
        if (auth()->user()->{User::field_role()} == RoleType::User) {
            $user = $user->where(User::field_primary(), auth()->user()
                    ->{User::field_primary()});
        }

        return $user->pluck(User::field_name(), User::field_primary());
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
        $ticket_topic = TicketTopic::optionBuild();
        $department = Department::optionBuild();
        $user = User::optionBuild(true);

        $status = TicketStatus::getOptions();
        $priority = TicketPriority::getOptions();

        $view = [
            'ticket_topic' => $ticket_topic,
            'department' => $department,
            'location' => $this->getLocation(),
            'implementor' => $this->getImplementor($user),
            'user' => $this->getUser($user),
            'status' => $status,
            'priority' => $priority,
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
        return view(Template::form(SharedData::get('template')))->with($this->share([
            'model' => $this->get($code),
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
