<?php

namespace App\Dao\Repositories;

use App\Dao\Enums\RoleType;
use App\Dao\Interfaces\CrudInterface;
use App\Dao\Models\WorkSheet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Plugins\Query;

class WorkSheetRepository extends MasterRepository implements CrudInterface, FromCollection
{
    public function __construct()
    {
        $this->model = empty($this->model) ? new WorkSheet() : $this->model;
    }

    public function dataRepository()
    {
        $query = $this->model->select(self::$paginate ? $this->model->getExcelField() : $this->model->getSelectedField())
            ->leftJoinRelationship('has_work_type')
            ->leftJoinRelationship('has_product')
            ->leftJoinRelationship('has_implementor')
            ->leftJoinRelationship('has_vendor')
            ->sortable()->filter();

        if(Query::getRole(auth()->user()->role) == RoleType::Pelaksana){
            $query = $query->where(WorkSheet::field_implement_by(), auth()->user()->id);
        }

        if(self::$paginate){
            $query = env('PAGINATION_SIMPLE') ? $query->simplePaginate(env('PAGINATION_NUMBER')) : $query->paginate(env('PAGINATION_NUMBER'));
        }

        return $query;
    }

    public function excel($name)
    {
        $this->model->selected_field = 'excel';
        $data = $this->setDisablePaginate()->dataRepository();
        return $this->model->export($data, $name);
    }

    public function collection()
    {
        return $this->setDisablePaginate()->dataRepository()->get();
    }
}
