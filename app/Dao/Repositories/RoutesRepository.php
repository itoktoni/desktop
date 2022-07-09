<?php

namespace App\Dao\Repositories;

use App\Dao\Interfaces\CrudInterface;
use App\Dao\Models\Routes;

class RoutesRepository extends MasterRepository implements CrudInterface
{
    public function __construct()
    {
        $this->model = empty($this->model) ? new Routes() : $this->model;
    }
}
