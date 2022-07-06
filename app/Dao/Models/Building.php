<?php

namespace App\Dao\Models;

use App\Dao\Builder\DataBuilder;
use App\Dao\Entities\BuildingEntity;
use App\Dao\Enums\UserType;
use App\Dao\Traits\DataTableTrait;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Mehradsadeghi\FilterQueryString\FilterQueryString as FilterQueryString;

class Building extends Model
{
    use Sortable, FilterQueryString, DataTableTrait, BuildingEntity;

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
        if($search){
            return $query->where($value ?? $this->fieldSearching(), 'like', "%{$search}%");
        }
    }

    public function fieldSearching(){
        return 'building_name';
    }

    public function fieldDatatable(): array
    {
        return [
            DataBuilder::build('building_id')->name('ID')->show(false),
            DataBuilder::build('building_name')->name('Name')->sort(),
            DataBuilder::build('building_description')->name('Description'),
            DataBuilder::build('building_contact_person')->name('Contact Person'),
            DataBuilder::build('building_contact_phone')->name('Contact Phone'),
            DataBuilder::build('building_address')->name('Address'),
        ];
    }
}
