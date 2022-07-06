<?php

namespace App\Dao\Models;

use App\Dao\Builder\DataBuilder;
use App\Dao\Entities\RoutesEntity;
use App\Dao\Enums\BooleanType;
use App\Dao\Traits\DataTableTrait;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Mehradsadeghi\FilterQueryString\FilterQueryString as FilterQueryString;
use Touhidurabir\ModelSanitize\Sanitizable as Sanitizable;

class Routes extends Model
{
    use Sortable, FilterQueryString, Sanitizable, DataTableTrait, RoutesEntity;

    protected $table = 'routes';
    protected $primaryKey = 'route_code';

    protected $fillable = [
        'route_code',
        'route_name',
        'route_group',
        'route_active',
        'route_controller',
        'route_description',
    ];

    public $sortable = [
        'route_code',
        'route_name',
        'route_group',
        'route_controller',
    ];

    protected $filters = [
        'filter',
    ];

    public $timestamps = false;
    public $incrementing = false;

    public function fieldSearching(){
        return 'route_name';
    }

    public function fieldDatatable(): array
    {
        return [
            DataBuilder::build('route_group')->name('Group')->sort(),
            DataBuilder::build('route_code')->name('Code')->sort(),
            DataBuilder::build('route_name')->name('Name')->sort(),
            DataBuilder::build('route_controller')->name('Controller')->sort(),
            DataBuilder::build('route_description')->name('Description')->show(false),
            DataBuilder::build('route_active')->name('Active')->class('col-md-1')->show(false),
        ];
    }

    public function scopeActive($query)
    {
        return $query->where($this->field_active(), BooleanType::Yes);
    }

}
