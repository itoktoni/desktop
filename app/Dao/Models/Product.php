<?php

namespace App\Dao\Models;

use App\Dao\Builder\DataBuilder;
use App\Dao\Entities\ProductEntity;
use App\Dao\Enums\BooleanType;
use App\Dao\Traits\DataTableTrait;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Mehradsadeghi\FilterQueryString\FilterQueryString as FilterQueryString;
use Touhidurabir\ModelSanitize\Sanitizable as Sanitizable;
use Wildside\Userstamps\Userstamps;

class Product extends Model
{
    use Sortable, FilterQueryString, Sanitizable, DataTableTrait, ProductEntity, Userstamps;

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
        return 'product_name';
    }

    public function fieldDatatable(): array
    {
        return [
            DataBuilder::build('product_id')->name('ID')->show(false),
            DataBuilder::build('category_name')->name('Category')->sort(),
            DataBuilder::build('product_name')->name('Product Name')->sort(),
            DataBuilder::build('product_description')->name('Description')->sort(),
            DataBuilder::build('product_active')->name('Active')->show(false),
        ];
    }

    public function scopeActive($query)
    {
        return $query->where($this->field_active(), BooleanType::Yes);
    }

    public function has_category(){

		return $this->hasOne(Category::class, Category::field_code(), $this::field_category_id());
	}

}
