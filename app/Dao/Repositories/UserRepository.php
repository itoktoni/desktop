<?php

namespace App\Dao\Repositories;

use App\Dao\Interfaces\CrudInterface;
use App\Dao\Models\User;

class UserRepository extends MasterRepository implements CrudInterface
{
    public function __construct()
    {
        $this->model = empty($this->model) ? new User() : $this->model;
    }
}
