<?php

namespace App\Dao\Models;

use App\Dao\Builder\DataBuilder;
use App\Dao\Entities\ProductEntity;
use App\Dao\Enums\BooleanType;
use App\Dao\Traits\ActiveTrait;
use App\Dao\Traits\DataTableTrait;
use App\Dao\Traits\OptionTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kirschbaum\PowerJoins\PowerJoins;
use Kyslik\ColumnSortable\Sortable;
use Mehradsadeghi\FilterQueryString\FilterQueryString as FilterQueryString;
use Touhidurabir\ModelSanitize\Sanitizable as Sanitizable;
use Wildside\Userstamps\Userstamps;

class Product extends Model
{
    use Sortable, FilterQueryString, Sanitizable, DataTableTrait, ProductEntity, Userstamps, SoftDeletes, ActiveTrait, PowerJoins, OptionTrait;

    protected $table = 'product';
    protected $primaryKey = 'product_id';

    protected $fillable = [
        'product_id',
        'product_name',
        'product_code',
        'product_image',
        'product_category_id',
        'product_brand_id',
        'product_unit_id',
        'product_description',
        'product_created_at',
        'product_updated_at',
        'product_deleted_at',
        'product_deleted_by',
        'product_updated_by',
        'product_created_by',
        'product_active',
    ];

    public $sortable = [
        'product_name',
        'category.category_name',
        'search',
        'brand.brand_name',
        'unit.unit_name',
    ];

    protected $filters = [
        'filter',
    ];

    protected $casts = [
        'product_active' => 'integer',
    ];

    public $timestamps = true;
    public $incrementing = true;

    const CREATED_AT = 'product_created_at';
    const UPDATED_AT = 'product_updated_at';
    const DELETED_AT = 'product_deleted_at';

    const CREATED_BY = 'product_created_by';
    const UPDATED_BY = 'product_updated_by';
    const DELETED_BY = 'product_deleted_by';

    public function fieldSearching()
    {
        return $this->field_name();
    }

    public function fieldDatatable(): array
    {
        return [
            DataBuilder::build($this->field_code())->name('ID')->show(false),
            DataBuilder::build($this->field_category_name())->name('Category')->sort(),
            DataBuilder::build($this->field_brand_name())->name('Brand')->sort(),
            DataBuilder::build($this->field_unit_name())->name('Unit')->sort(),
            DataBuilder::build($this->field_name())->name('Product Name')->sort(),
            DataBuilder::build($this->field_description())->name('Description'),
            DataBuilder::build($this->field_active())->name('Active')->class('column-active text-center'),
        ];
    }

    public function has_category(){

		return $this->hasOne(Category::class, Category::field_code(), self::field_category_id());
	}

    public function has_brand()
    {
		return $this->hasOne(Brand::class, Brand::field_code(), self::field_brand_id());
	}

    public function has_unit()
    {
		return $this->hasOne(Unit::class, Unit::field_code(), self::field_unit_id());
	}

    public function categoryNameSortable($query, $direction)
    {
        $query = $this->queryFilter($query);
        $query = $query->orderBy($this->field_category_name(), $direction);
        return $query;
    }

    public function brandNameSortable($query, $direction)
    {
        $query = $this->queryFilter($query);
        $query = $query->orderBy($this->field_brand_name(), $direction);
        return $query;
    }

    public function unitNameSortable($query, $direction)
    {
        $query = $this->queryFilter($query);
        $query = $query->orderBy($this->field_unit_name(), $direction);
        return $query;
    }

}
