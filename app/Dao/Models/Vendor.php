<?php

namespace App\Dao\Models;

use App\Dao\Builder\DataBuilder;
use App\Dao\Entities\VendorEntity;
use App\Dao\Traits\ActiveTrait;
use App\Dao\Traits\DataTableTrait;
use App\Dao\Traits\OptionTrait;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Mehradsadeghi\FilterQueryString\FilterQueryString as FilterQueryString;
use Touhidurabir\ModelSanitize\Sanitizable as Sanitizable;

class Vendor extends Model
{
    use Sortable, FilterQueryString, Sanitizable, DataTableTrait, VendorEntity, ActiveTrait, OptionTrait;

    protected $table = 'vendor';
    protected $primaryKey = 'vendor_id';

    protected $fillable = [
        'vendor_id',
        'vendor_name',
        'vendor_contact',
        'vendor_address',
        'vendor_email',
        'vendor_phone',
    ];

    public $sortable = [
        'vendor_name',
        'vendor_email',
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
            DataBuilder::build($this->field_primary())->name('ID')->show(false),
            DataBuilder::build($this->field_name())->name('Name')->sort(),
            DataBuilder::build($this->field_contact())->name('Contact'),
            DataBuilder::build($this->field_address())->name('Address'),
            DataBuilder::build($this->field_email())->name('Email')->sort(),
            DataBuilder::build($this->field_phone())->name('Phone'),
        ];
    }
}