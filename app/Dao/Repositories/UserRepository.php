<?php

namespace App\Dao\Repositories;

use App\Dao\Builder\DataBuilder;
use App\Dao\Interfaces\CrudInterface;
use App\Dao\Models\User;
use App\Dao\Traits\DataTableTrait;
use Illuminate\Database\QueryException;
use Plugins\Notes;

class UserRepository implements CrudInterface
{
    public $model;

    public function __construct()
    {
        $this->model = empty($this->model) ? new User() : $this->model;
    }

    public function dataRepository()
    {
        try {
            $query = $this->model
                ->select($this->model->getSelectedField())
                ->active()->sortable()->filter();

            $query = env('PAGINATION_SIMPLE') ? $query->simplePaginate(env('PAGINATION_NUMBER')) : $query->Paginate(env('PAGINATION_NUMBER'));

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
            $update = $this->model->findOrFail($code);
            $update->update($request);
            return Notes::update($update);
        } catch (QueryException $ex) {
            return Notes::error($ex->getMessage());
        }
    }

    public function deleteRepository($request)
    {
        try {
            is_array($request) ? $this->model->destroy(array_values($request)) : $this->model->destroy($request);
            return Notes::delete($request);
        } catch (QueryException $ex) {
            return Notes::error($ex->getMessage());
        }
    }

    public function singleRepository($code, $relation = false)
    {
        try {
            return $relation ? $this->model->with($relation)->findOrFail($code) : $this->model->findOrFail($code);
        } catch (QueryException $ex) {
            abort(500, $ex->getMessage());
        }
    }

}
