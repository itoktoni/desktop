<?php

namespace App\Http\Controllers\Master;

use App\Dao\Enums\BooleanType;
use App\Http\Controllers\Controller;
use App\Http\Requests\DeleteRequest;
use App\Http\Services\DeleteService;
use Coderello\SharedData\Facades\SharedData;
use Plugins\Response;
use Plugins\Template;

class MasterController extends Controller
{
    public static $service;
    public static $repository;
    public static $template;

    private function share($data = [])
    {
        $status = BooleanType::getOptions();
        $view = [
            'status' => $status,
        ];
        return array_merge($view, $data);
    }

    public function getData()
    {
        $query = self::$repository->dataRepository();
        return $query;
    }

    public function getTable()
    {
        $data = $this->getData();
        return view(Template::table(SharedData::get('template')))->with($this->share([
            'data' => $data,
            'fields' => self::$repository->model->getShowField(),
        ]));
    }

    public function getCreate()
    {
        return view(Template::form(SharedData::get('template')))->with($this->share());
    }

    public function getUpdate($code)
    {
        return view(Template::form(SharedData::get('template')))->with($this->share([
            'model' => $this->get($code),
        ]));
    }

    public function get($code = null, $relation = null)
    {
        $relation = $relation ?? request()->get('relation');
        if ($relation) {
            return self::$service->get(self::$repository, $code, $relation);
        }
        return self::$service->get(self::$repository, $code);
    }

    public function postDelete(DeleteRequest $request, DeleteService $service)
    {
        $code = $request->get('code');
        $data = $service->delete(self::$repository, $code);
        return Response::redirectBack($data);
    }
}
