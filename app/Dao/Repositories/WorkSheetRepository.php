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
        $query = $this->model->select(self::$excel ? $this->model->getExcelField() : $this->model->getSelectedField())
            ->leftJoinRelationship('has_work_type')
            ->leftJoinRelationship('has_product')
            ->sortable()->filter();

        if(!self::$excel){
            $query = env('PAGINATION_SIMPLE') ? $query->simplePaginate(env('PAGINATION_NUMBER')) : $query->paginate(env('PAGINATION_NUMBER'));
        }

        return $query;
    }

    public function excel($name)
    {
        $this->model->selected_field = 'excel';
        $data = $this->setExcel()->dataRepository();
        return $this->model->export($data, $name);
    }
}
