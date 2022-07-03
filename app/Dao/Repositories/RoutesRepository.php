<?php

namespace App\Dao\Repositories;

use App\Dao\Interfaces\CrudInterface;
use App\DatabaseJson\Models\Routes;
use Illuminate\Database\QueryException;
use Plugins\Notes;

class RoutesRepository implements CrudInterface
{
    public $model;

    public function __construct()
    {
        $this->model = empty($this->model) ? new Routes() : $this->model;
    }

    public function dataRepository()
    {
        try {
            $query = $this->model;
            if($search = request()->get('search')){
                $query = $query->where(request()->get('filter') ?? 'route_name', $search);
            }
            $query = $query->paginate(env('PAGINATION_NUMBER'));

            return $query;
        } catch (QueryException $ex) {
            return Notes::error($ex->getMessage());
        }
    }

    public function saveRepository($request)
    {
        try {
            $activity = $this->model->create($request);
            return Notes::create($activity);
        } catch (QueryException $ex) {
            return Notes::error($ex->getMessage());
        }
    }

    public function updateRepository($request, $code)
    {
        try {
            $activity = $this->model->update($request, $code);
            return Notes::update($activity);
        } catch (QueryException $ex) {
            return Notes::error($ex->getMessage());
        }
    }

    public function deleteRepository($request)
    {
        try {
            if (is_array($request)) {
                $this->model->find($request)->delete();
            } else {
                $this->model->find($request)->delete();
            }
            return Notes::delete($request);
        } catch (QueryException $ex) {
            return Notes::error($ex->getMessage());
        }
    }

    public function singleRepository($code, $relation = false)
    {
        try {
            return $relation ? $this->model->with($relation)->find($code) : $this->model->find($code);
        } catch (QueryException $ex) {
            abort(500, $ex->getMessage());
        }
    }

}
