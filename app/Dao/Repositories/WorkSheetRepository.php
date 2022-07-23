<?php

namespace App\Dao\Repositories;

use App\Dao\Interfaces\CrudInterface;
use App\Dao\Models\WorkSheet;

class WorkSheetRepository extends MasterRepository implements CrudInterface
{
    public function __construct()
    {
        $this->model = empty($this->model) ? new WorkSheet() : $this->model;
    }

    public function dataRepository()
    {
        $query = $this->model->select($this->model->getSelectedField())
            ->leftJoinRelationship('has_work_type')
            ->leftJoinRelationship('has_product')
            ->sortable()->filter();

        $query = env('PAGINATION_SIMPLE') ? $query->simplePaginate(env('PAGINATION_NUMBER')) : $query->paginate(env('PAGINATION_NUMBER'));

        return $query;
    }
}
