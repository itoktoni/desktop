<?php

namespace App\Dao\Models;

use App\Dao\Builder\DataBuilder;
use App\Dao\Entities\RoutesEntity;
use App\Dao\Enums\BooleanType;
use App\Dao\Traits\ActiveTrait;
use App\Dao\Traits\DataTableTrait;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Mehradsadeghi\FilterQueryString\FilterQueryString as FilterQueryString;
use Touhidurabir\ModelSanitize\Sanitizable as Sanitizable;

class Routes extends Model
{
    use Sortable, FilterQueryString, Sanitizable, DataTableTrait, RoutesEntity, ActiveTrait, ActiveTrait;

    protected $table = 'routes';
    protected $primaryKey = 'route_code';

    protected $fillable = [
        'route_code',
        'route_name',
        'route_group',
        'route_active',
        'route_controller',
        'route_description',
        'route_sort',
    ];

    public $sortable = [
        'route_code',
        'route_name',
        'route_group',
        'route_controller',
        'route_sort',
    ];

    protected $filters = [
        'filter',
    ];

    public $timestamps = false;
    public $incrementing = false;

    public function fieldSearching(){
        return $this->field_name();
    }

    public function fieldDatatable(): array
    {
        return [
            DataBuilder::build($this->field_group())->name('Group')->sort(),
            DataBuilder::build($this->field_code())->name('Code')->sort(),
            DataBuilder::build($this->field_name())->name('Name')->sort(),
            DataBuilder::build($this->field_controller())->name('Controller')->sort(),
            DataBuilder::build($this->field_description())->name('Description')->show(false),
            DataBuilder::build($this->field_sort())->name('Sort')->sort()->class('column-active'),
            DataBuilder::build($this->field_active())->name('Active')->show(false),
        ];
    }

    public function has_menu(){
		return $this->hasMany(Menus::class, Menus::field_module(), $this::field_code());
	}
}
