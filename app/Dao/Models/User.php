<?php

namespace App\Dao\Models;

use App\Dao\Builder\DataBuilder;
use App\Dao\Entities\UserEntity;
use App\Dao\Traits\ActiveTrait;
use App\Dao\Traits\DataTableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;
use Mehradsadeghi\FilterQueryString\FilterQueryString as FilterQueryString;
use Touhidurabir\ModelSanitize\Sanitizable as Sanitizable;

class User extends Authenticatable
{
    use Notifiable, Sortable, FilterQueryString, Sanitizable, DataTableTrait, UserEntity, ActiveTrait;

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

    public $timestamps = true;
    public $incrementing = true;

    public function fieldSearching(){
        return $this->field_name();
    }

    public function fieldDatatable(): array
    {
        return [
            DataBuilder::build($this->field_code())->name('ID')->show(false),
            DataBuilder::build($this->field_name())->name('Name')->sort(),
            DataBuilder::build($this->field_email())->name('Email'),
            DataBuilder::build($this->field_active())->name('Active')->show(false),
        ];
    }
}
