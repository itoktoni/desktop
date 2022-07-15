<?php

namespace App\Dao\Models;

use App\Dao\Builder\DataBuilder;
use App\Dao\Entities\BuildingEntity;
use App\Dao\Traits\ActiveTrait;
use App\Dao\Traits\DataTableTrait;
use App\Dao\Traits\OptionTrait;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Mehradsadeghi\FilterQueryString\FilterQueryString as FilterQueryString;

class Building extends Model
{
    use Sortable, FilterQueryString, DataTableTrait, BuildingEntity, ActiveTrait, OptionTrait;

    protected $table = 'building';
    protected $primaryKey = 'building_id';

    protected $fillable = [
        'building_id',
        'building_name',
        'building_description',
        'building_contact_person',
        'building_contact_phone',
        'building_address',
    ];

    public $sortable = [
        'building_name',
    ];

    protected $filters = [
        'filter',
    ];

    public $timestamps = false;
    public $incrementing = true;

    public function filter($query, $value)
    {
        $search = request()->get('search');
        if ($search) {
            return $query->where($value ?? $this->fieldSearching(), 'like', "%{$search}%");
        }
    }

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
            DataBuilder::build($this->field_contact_person())->name('Contact Person'),
            DataBuilder::build($this->field_contact_phone())->name('Contact Phone'),
            DataBuilder::build($this->field_address())->name('Address'),
        ];
    }
}
