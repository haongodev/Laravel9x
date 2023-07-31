<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int      $id
 * @property int      $id
 * @property int      $share_flg
 * @property int      $share_flg
 * @property DateTime $delete_date
 * @property DateTime $registration_date
 * @property DateTime $update_date
 * @property DateTime $delete_date
 * @property DateTime $registration_date
 * @property DateTime $update_date
 * @property string   $file_name
 * @property string   $file_name
 */
class FacesheetManage extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'facesheet_manage';

    /**
     * The database edit column updated_at name to update_date.
     *
     * @var DateTime
     */

     const UPDATED_AT = 'update_date';
         /**
     * The database edit column created_at name to update_date.
     *
     * @var DateTime
     */

     const CREATED_AT = 'registration_date';
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
        'delete_date', 'file_name', 'registration_date', 'share_flg', 'update_date', 'delete_date', 'file_name', 'registration_date', 'share_flg', 'update_date', 'member_id', 'display_name'
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
        'id' => 'int', 'id' => 'int', 'delete_date' => 'datetime', 'file_name' => 'string', 'registration_date' => 'datetime', 'share_flg' => 'int', 'update_date' => 'datetime', 'delete_date' => 'datetime', 'file_name' => 'string', 'registration_date' => 'datetime', 'share_flg' => 'int', 'update_date' => 'datetime'
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
