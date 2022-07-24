<?php

namespace App\Dao\Models;

use App\Dao\Builder\DataBuilder;
use App\Dao\Entities\MenusEntity;
use App\Dao\Traits\ActiveTrait;
use App\Dao\Traits\DataTableTrait;
use App\Dao\Traits\OptionTrait;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Mehradsadeghi\FilterQueryString\FilterQueryString as FilterQueryString;

class Menus extends Model
{
    use Sortable, FilterQueryString, DataTableTrait, MenusEntity, OptionTrait, ActiveTrait;

    protected $table = 'menus';
    protected $primaryKey = 'menu_code';

    protected $fillable = [
        'menu_code',
        'menu_name',
        'menu_module',
        'menu_description',
        'menu_active',
        'menu_reset',
        'menu_show',
    ];

    public $sortable = [
        'menu_name',
    ];

    protected $filters = [
        'filter',
    ];

    public $timestamps = false;
    public $incrementing = false;

    public function fieldSearching()
    {
        return $this->field_name();
    }

    public function fieldDatatable(): array
    {
        return [
            DataBuilder::build($this->field_primary())->name('ID')->show(false),
            DataBuilder::build($this->field_name())->name('Name')->sort(),
            DataBuilder::build($this->field_description())->name('Description'),
            DataBuilder::build($this->field_active())->name('Active')->show(false),
        ];
    }
}
