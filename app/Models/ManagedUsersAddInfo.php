<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ManagedUsersAddInfo
 * @package App\Models
 */
class ManagedUsersAddInfo extends Model
{
    use SoftDeletes;// add soft delete
    const DELETED_AT = 'delete_date';
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'managed_users_add_info';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'users_id', 'login_id', 'manager_class', 'attribute', 'delete_flg', 'registration_date', 'update_date'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'int',
        'users_id' => 'int',
        'manager_class' => 'int',
        'attribute' => 'int',
        'delete_flg' => 'boolean',
        'registration_date' => 'datetime',
        'update_date' => 'datetime',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'registration_date', 'update_date', 'registration_date', 'update_date'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = true;

    // Scopes...

    // Functions ...

    // Relations ...
}
