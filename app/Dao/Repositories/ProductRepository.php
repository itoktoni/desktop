<?php

namespace App\Dao\Repositories;

use App\Dao\Interfaces\CrudInterface;
use App\Dao\Models\Category;
use App\Dao\Models\Product;
use Illuminate\Database\QueryException;
use Kirschbaum\PowerJoins\PowerJoins;
use Plugins\Notes;

class ProductRepository extends Product implements CrudInterface
{
    use PowerJoins;

    public function __construct()
    {
        $this->model = $this;
    }

    public function categoryNameSortable($query, $direction)
    {
        return $query->orderBy($this->field_category_name(), $direction);
    }

    public function dataRepository()
    {
        try {
            $query = $this->model->select($this->model->getSelectedField())
                ->leftJoinRelationship('has_category')
                ->active()->sortable()->filter();

            $query = env('PAGINATION_SIMPLE') ? $query->simplePaginate(env('PAGINATION_NUMBER')) : $query->paginate(env('PAGINATION_NUMBER'));

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
