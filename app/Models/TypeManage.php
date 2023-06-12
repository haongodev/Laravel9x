<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int      $id
 * @property int      $type_native_id
 * @property int      $id
 * @property int      $type_native_id
 * @property int      $active_flg
 * @property int      $no_edit_flg
 * @property boolean  $active_flg
 * @property boolean  $no_edit_flg
 * @property DateTime $delete_date
 * @property DateTime $registration_date
 * @property DateTime $update_date
 * @property DateTime $delete_date
 * @property DateTime $registration_date
 * @property DateTime $update_date
 * @property string   $type_name
 * @property string   $type_name
 */
class TypeManage extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'type_manage';

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
        'type_native_id', 'type_native_id', 'active_flg', 'delete_date', 'no_edit_flg', 'registration_date', 'type_name', 'update_date', 'active_flg', 'delete_date', 'no_edit_flg', 'registration_date', 'type_name', 'update_date'
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
        'id' => 'int', 'type_native_id' => 'int', 'id' => 'int', 'type_native_id' => 'int', 'active_flg' => 'boolean', 'delete_date' => 'datetime', 'no_edit_flg' => 'boolean', 'registration_date' => 'datetime', 'type_name' => 'string', 'update_date' => 'datetime', 'active_flg' => 'int', 'delete_date' => 'datetime', 'no_edit_flg' => 'int', 'registration_date' => 'datetime', 'type_name' => 'string', 'update_date' => 'datetime'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'delete_date', 'registration_date', 'update_date', 'delete_date', 'registration_date', 'update_date'
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
