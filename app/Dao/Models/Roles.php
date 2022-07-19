<?php

namespace App\Dao\Models;

use App\Dao\Builder\DataBuilder;
use App\Dao\Entities\RolesEntity;
use App\Dao\Traits\ActiveTrait;
use App\Dao\Traits\DataTableTrait;
use App\Dao\Traits\OptionTrait;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Mehradsadeghi\FilterQueryString\FilterQueryString as FilterQueryString;
use Touhidurabir\ModelSanitize\Sanitizable as Sanitizable;

class Roles extends Model
{
    use Sortable, FilterQueryString, Sanitizable, DataTableTrait, RolesEntity, ActiveTrait, OptionTrait;

    protected $table = 'roles';
    protected $primaryKey = 'role_code';

    protected $fillable = [
        'role_code',
        'role_name',
        'role_description',
        'role_active',
    ];

    public $sortable = [
        'role_name',
    ];

    protected $filters = [
        'filter',
    ];

    public $timestamps = false;
    public $incrementing = true;

    public function fieldSearching()
    {
        return $this->field_name();
    }

    public function fieldDatatable(): array
    {
        return [
            DataBuilder::build($this->field_code())->name('ID')->show(false),
            DataBuilder::build($this->field_name())->name('Name')->sort(),
            DataBuilder::build($this->field_description())->name('Description'),
            DataBuilder::build($this->field_active())->name('Active')->show(false),
        ];
    }
}
