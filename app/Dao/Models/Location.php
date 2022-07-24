<?php

namespace App\Dao\Models;

use App\Dao\Builder\DataBuilder;
use App\Dao\Entities\LocationEntity;
use App\Dao\Traits\ActiveTrait;
use App\Dao\Traits\DataTableTrait;
use App\Dao\Traits\OptionTrait;
use Illuminate\Database\Eloquent\Model;
use Kirschbaum\PowerJoins\PowerJoins;
use Kyslik\ColumnSortable\Sortable;
use Mehradsadeghi\FilterQueryString\FilterQueryString as FilterQueryString;
use Touhidurabir\ModelSanitize\Sanitizable as Sanitizable;

class Location extends Model
{
    use Sortable, FilterQueryString, Sanitizable, DataTableTrait, LocationEntity, OptionTrait, PowerJoins, ActiveTrait;

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
            DataBuilder::build($this->field_primary())->name('Code')->show(false),
            DataBuilder::build(Building::field_name())->name('Building')->sort(),
            DataBuilder::build($this->field_name())->name('Name')->sort(),
            DataBuilder::build($this->field_description())->name('Description'),
        ];
    }

    public function has_building()
    {
        return $this->hasOne(Building::class, Building::field_primary(), self::field_building_id());
    }

    public function buildingNameSortable($query, $direction)
    {
        $query = $this->queryFilter($query);
        $query = $query->orderBy(Building::field_name(), $direction);
        return $query;
    }
}
