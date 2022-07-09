<?php

namespace App\Dao\Models;

use App\Dao\Builder\DataBuilder;
use App\Dao\Entities\SparepartEntity;
use App\Dao\Enums\UserType;
use App\Dao\Traits\ActiveTrait;
use App\Dao\Traits\DataTableTrait;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Mehradsadeghi\FilterQueryString\FilterQueryString as FilterQueryString;

class Sparepart extends Model
{
    use Sortable, FilterQueryString, DataTableTrait, SparepartEntity, ActiveTrait;

    protected $table = 'sparepart';
    protected $primaryKey = 'sparepart_id';

    protected $fillable = [
      'sparepart_id',
      'sparepart_name',
      'sparepart_location_id',
      'sparepart_description',
      'sparepart_stock',
    ];

    public $sortable = [
        'sparepart_name',
        'sparepart_stock',
    ];

    protected $filters = [
        'filter',
    ];

    public $timestamps = false;
    public $incrementing = true;

    public function fieldSearching(){
        return $this->field_name();
    }

    public function fieldDatatable(): array
    {
        return [
            DataBuilder::build($this->field_code())->name('ID')->show(false),
            DataBuilder::build($this->field_name())->name('Name')->sort(),
            DataBuilder::build($this->field_location_id())->name('Location ID'),
            DataBuilder::build($this->field_description())->name('Description'),
            DataBuilder::build($this->field_stock())->name('Stock')->sort(),
        ];
    }
}
