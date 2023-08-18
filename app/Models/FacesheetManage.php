<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Class FacesheetManage
 * @package App\Models
 */
class FacesheetManage extends Model
{
    use SoftDeletes;// add soft delete
    const DELETED_AT = 'delete_date';
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
        'id','file_name', 'share_flg','delete_date','update_date','registration_date','member_id','display_name'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [

    ];



    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'delete_date', 'registration_date', 'update_date',
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
