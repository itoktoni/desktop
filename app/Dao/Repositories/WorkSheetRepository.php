<?php

namespace App\Dao\Repositories;

use App\Dao\Interfaces\CrudInterface;
use App\Dao\Models\WorkSheet;
use App\Dao\Traits\ExcelTrait;

class WorkSheetRepository extends MasterRepository implements CrudInterface
{
    use ExcelTrait;

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

        if(self::$paginate){
            $query = env('PAGINATION_SIMPLE') ? $query->simplePaginate(env('PAGINATION_NUMBER')) : $query->paginate(env('PAGINATION_NUMBER'));
        }

        return $query;
    }

    public function excel($name)
    {
        $data = $this->setDisablePaginate()->dataRepository()->get();
        return $this->export($data, $name);
    }
}
