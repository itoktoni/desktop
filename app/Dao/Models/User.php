<?php

namespace App\Dao\Models;

use App\Dao\Builder\DataBuilder;
use App\Dao\Entities\UserEntity;
use App\Dao\Enums\UserType;
use App\Dao\Traits\DataTableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;
use Mehradsadeghi\FilterQueryString\FilterQueryString as FilterQueryString;
use Touhidurabir\ModelSanitize\Sanitizable as Sanitizable;

class User extends Authenticatable
{
    use Notifiable, Sortable, FilterQueryString, Sanitizable, DataTableTrait, UserEntity;

    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'group',
        'active',
    ];

    public $sortable = [
        'name',
        'email',
    ];

    protected $filters = [
        'filter',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public $timestamps = false;
    public $incrementing = true;

    const CREATED_AT = 'item_linen_created_at';
    const UPDATED_AT = 'item_linen_updated_at';
    const DELETED_AT = 'item_linen_deleted_at';

    const CREATED_BY = 'item_linen_created_by';
    const UPDATED_BY = 'item_linen_updated_by';
    const DELETED_BY = 'item_linen_deleted_by';

    public function fieldSearching(){
        return 'name';
    }

    public function fieldDatatable(): array
    {
        return [
            DataBuilder::build('id')->name('ID')->show(false),
            DataBuilder::build('name')->name('Name')->sort(),
            DataBuilder::build('email')->name('Email'),
        ];
    }

    public function scopeActive($query)
    {
        return $query->where($this->field_active(), UserType::Active);
    }
 
}
