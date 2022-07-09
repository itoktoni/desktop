<?php

namespace App\Dao\Models;

use App\Dao\Builder\DataBuilder;
use App\Dao\Entities\GroupsEntity;
use App\Dao\Traits\ActiveTrait;
use App\Dao\Traits\DataTableTrait;
use App\Dao\Traits\OptionTrait;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Mehradsadeghi\FilterQueryString\FilterQueryString as FilterQueryString;
use Touhidurabir\ModelSanitize\Sanitizable as Sanitizable;
use Illuminate\Support\Str;

class Groups extends Model
{
    use Sortable, FilterQueryString, Sanitizable, DataTableTrait, GroupsEntity, ActiveTrait, OptionTrait;

    protected $table = 'groups';
    protected $primaryKey = 'group_code';

    protected $fillable = [
        'group_code',
        'group_name',
        'group_icon',
        'group_active',
        'group_sort',
    ];

    public $sortable = [
        'group_name',
        'group_sort',
    ];

    protected $filters = [
        'filter',
    ];

    public $timestamps = false;
    public $incrementing = false;

    public function fieldSearching()
    {
        return $this->field_name();
    }

    public function fieldDatatable(): array
    {
        return [
            DataBuilder::build($this->field_code())->name('Code'),
            DataBuilder::build($this->field_name())->name('Name')->sort(),
            DataBuilder::build($this->field_icon())->name('Icon')->sort(),
            DataBuilder::build($this->field_url())->name('Url')->sort(),
            DataBuilder::build($this->field_sort())->name('Sort')->sort()->class('column-active'),
            DataBuilder::build($this->field_active())->name('Active')->show(false),
        ];
    }

    public static function boot(){

        parent::saving(function ($model) {
            $model->group_code = Str::snake($model->group_name);
        });

        parent::boot();
    }
}
