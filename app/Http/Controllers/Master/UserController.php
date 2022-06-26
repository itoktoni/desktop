<?php

namespace App\Http\Controllers\Master;

use App\Dao\Enums\CategoryType;
use App\Dao\Models\User;
use App\Dao\Repositories\CategoryRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\DeleteRequest;
use App\Http\Requests\GeneralRequest;
use App\Http\Services\CreateService;
use App\Http\Services\DataService;
use App\Http\Services\DeleteService;
use App\Http\Services\SingleService;
use App\Http\Services\UpdateService;
use Illuminate\Http\Request;
use Plugins\Helper;
use Plugins\Response;
use Plugins\Views;

class UserController extends Controller
{
    public static $template;
    public static $service;
    public static $model;

    public function __construct(CategoryRepository $model, SingleService $service)
    {
        self::$model = self::$model ?? $model;
        self::$service = self::$service ?? $service;
    }

    private function share($data = [])
    {
        $category = CategoryType::getOptions();
        $view = [
            'category' => $category,
        ];
        return array_merge($view, $data);
    }

    public function getTable()
    {
        $data = $this->getData();
        return view('pages.user.table')->with($this->share([
            'data' => $data
        ]));
    }

    public function getCreate()
    {
        return view('category.form')->with($this->share());
    }

    public function postCreate(Request $request, CreateService $service)
    {
        $data = $service->save(self::$model, $request);
        return Response::redirectBack($data);
    }

    public function getData()
    {
        return User::query()->paginate(10);
    }

    public function edit($code)
    {
        return view(Views::update())->with($this->share([
            'model' => $this->get($code),
        ]));
    }

    public function update($code, GeneralRequest $request, UpdateService $service)
    {
        $data = $service->update(self::$model, $request, $code);
        return Response::redirectBack($data);
    }

    public function show($code)
    {
        return view(Views::show())->with($this->share([
            'fields' => Helper::listData(self::$model->datatable),
            'model' => $this->get($code),
        ]));
    }

    public function get($code = null, $relation = null)
    {
        $relation = $relation ?? request()->get('relation');
        if ($relation) {
            return self::$service->get(self::$model, $code, $relation);
        }
        return self::$service->get(self::$model, $code);
    }

    public function delete(DeleteRequest $request, DeleteService $service)
    {
        $code = $request->get('code');
        $data = $service->delete(self::$model, $code);
        return Response::redirectBack($data);
    }
}
