<?php

namespace App\Dao\Traits;

use Facades\App\Models\User;
use Illuminate\Support\Facades\Cache;
use Facades\Modules\System\Dao\Models\Filter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

trait DataTableTrait
{
    abstract public function fieldDatatable(): array;
    abstract public function fieldSearching(): string;

    public function getSelectedField(): array
    {
        return collect($this->fieldDatatable())->pluck('code')->toArray();
    }

    public function getShowField()
    {
        return collect($this->fieldDatatable())->where('show', true);
    }
}
