<?php

namespace App\Http\Controllers\Master;

use App\Dao\Models\Roles;
use App\Dao\Repositories\UserRepository;
use App\Http\Controllers\System\MasterController;
use App\Http\Requests\UserRequest;
use App\Http\Services\CreateService;
use App\Http\Services\SingleService;
use App\Http\Services\UpdateService;
use Coderello\SharedData\Facades\SharedData;
use Plugins\Response;
use Plugins\Template;

class UserController extends MasterController
{
    public function __construct(UserRepository $repository, SingleService $service)
    {
        self::$repository = self::$repository ?? $repository;
        self::$service = self::$service ?? $service;
    }

    protected function beforeForm()
    {
        $roles = Roles::optionBuild();
        self::$share = [
            'roles' => $roles,
        ];
    }

    public function postCreate(UserRequest $request, CreateService $service)
    {
        $data = $service->save(self::$repository, $request);
        return Response::redirectBack($data);
    }

    public function postUpdate($code, UserRequest $request, UpdateService $service)
    {
        $data = $service->update(self::$repository, $request, $code);
        return Response::redirectBack($data);
    }
}
