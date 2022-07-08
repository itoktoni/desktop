<?php

namespace App\Dao\Models;

use App\Dao\Builder\DataBuilder;
use App\Dao\Entities\CategoryEntity;
use App\Dao\Enums\BooleanType;
use App\Dao\Traits\DataTableTrait;
use App\Dao\Traits\OptionTrait;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Mehradsadeghi\FilterQueryString\FilterQueryString as FilterQueryString;
use Touhidurabir\ModelSanitize\Sanitizable as Sanitizable;

class Category extends Model
{
    use Sortable, FilterQueryString, Sanitizable, DataTableTrait, CategoryEntity, OptionTrait;

    protected $table = 'category';
    protected $primaryKey = 'category_id';

    protected $fillable = [
        'category_id',
        'category_name',
        'category_description',
        'category_active',
    ];

    public $sortable = [
        'category_name',
    ];

    protected $filters = [
        'filter',
    ];

    public $timestamps = false;
    public $incrementing = true;

    public function fieldSearching()
    {
        return 'category_name';
    }

    public function fieldDatatable(): array
    {
        return [
            DataBuilder::build('category_id')->name('ID')->show(false),
            DataBuilder::build('category_name')->name('Name')->sort(),
            DataBuilder::build('category_description')->name('Description'),
            DataBuilder::build('category_active')->name('Active')->show(false),
        ];
    }

    public function scopeActive($query)
    {
        return $query->where($this->field_active(), BooleanType::Yes);
    }

    public static function optionId()
    {
        return '';
    }

    public static function optionName()
    {
        return '';
    }

    public static function optionData()
    {
        return '';
    }

}
