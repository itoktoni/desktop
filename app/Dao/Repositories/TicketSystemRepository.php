<?php

namespace App\Dao\Repositories;

use App\Dao\Interfaces\CrudInterface;
use App\Dao\Models\TicketSystem;
use Maatwebsite\Excel\Concerns\FromCollection;

class TicketSystemRepository extends MasterRepository implements CrudInterface, FromCollection
{
    public function __construct()
    {
        $this->model = empty($this->model) ? new TicketSystem() : $this->model;
    }

    public function dataRepository()
    {
        $query = $this->model->select(self::$paginate ? $this->model->getExcelField() : $this->model->getSelectedField())
            ->leftJoinRelationship('has_ticket_topic')
            ->leftJoinRelationship('has_department')
            ->sortable()->filter();

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

    public function getTicketByCode($id)
    {
        return $this->model->find($id);
    }
}
