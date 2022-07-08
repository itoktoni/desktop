<?php

namespace App\Dao\Repositories;

use App\Dao\Interfaces\CrudInterface;
use App\Dao\Models\Product;

class ProductRepository extends MasterRepository implements CrudInterface
{
    public $model;

    public function __construct()
    {
        $this->model = empty($this->model) ? new Product() : $this->model;
    }
}
