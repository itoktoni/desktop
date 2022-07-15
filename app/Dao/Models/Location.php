<?php

namespace App\Dao\Models;

use App\Dao\Builder\DataBuilder;
use App\Dao\Entities\LocationEntity;
use App\Dao\Traits\DataTableTrait;
use Illuminate\Database\Eloquent\Model;
use Kirschbaum\PowerJoins\PowerJoins;
use Kyslik\ColumnSortable\Sortable;
use Mehradsadeghi\FilterQueryString\FilterQueryString as FilterQueryString;
use Touhidurabir\ModelSanitize\Sanitizable as Sanitizable;

class Location extends Model
{
    use Sortable, FilterQueryString, Sanitizable, DataTableTrait, LocationEntity, PowerJoins;

    protected $table = 'location';
    protected $primaryKey = 'location_id';

    protected $fillable = [
        'location_id',
        'location_name',
        'location_description',
        'location_building_id',
    ];

    public $sortable = [
        'location_name',
        'building.building_name',
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
            DataBuilder::build($this->field_code())->name('Code')->show(false),
            DataBuilder::build($this->field_building_name())->name('Building')->sort(),
            DataBuilder::build($this->field_name())->name('Name')->sort(),
            DataBuilder::build($this->field_description())->name('Description'),
        ];
    }

    public function has_building()
    {
        return $this->hasOne(Building::class, Building::field_code(), $this::field_building_id());
    }

    public function buildingNameSortable($query, $direction)
    {
        $query = $this->queryFilter($query);
        $query = $query->orderBy($this->field_building_name(), $direction);
        return $query;
    }
}
