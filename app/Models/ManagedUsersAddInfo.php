<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int      $id
 * @property int      $id
 * @property int      $attribute
 * @property int      $manager_class
 * @property int      $users_id
 * @property int      $attribute
 * @property int      $delete_flg
 * @property int      $manager_class
 * @property int      $users_id
 * @property boolean  $delete_flg
 * @property DateTime $registration_date
 * @property DateTime $update_date
 * @property DateTime $registration_date
 * @property DateTime $update_date
 */
class ManagedUsersAddInfo extends Model
{
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
        'attribute', 'delete_flg', 'manager_class', 'registration_date', 'update_date', 'users_id', 'attribute', 'delete_flg', 'manager_class', 'registration_date', 'update_date', 'users_id'
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
        'id' => 'int', 'id' => 'int', 'attribute' => 'int', 'delete_flg' => 'boolean', 'manager_class' => 'int', 'registration_date' => 'datetime', 'update_date' => 'datetime', 'users_id' => 'int', 'attribute' => 'int', 'delete_flg' => 'int', 'manager_class' => 'int', 'registration_date' => 'datetime', 'update_date' => 'datetime', 'users_id' => 'int'
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
