<?php

namespace App\Dao\Repositories;

use App\Dao\Interfaces\CrudInterface;
use App\Dao\Models\Sparepart;

class SparepartRepository extends MasterRepository implements CrudInterface
{
    public $model;

    public function __construct()
    {
        $this->model = empty($this->model) ? new Sparepart() : $this->model;
    }
}
