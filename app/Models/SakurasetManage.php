<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int      $id
 * @property int      $id
 * @property int      $reviewer_status
 * @property int      $reviewer_status
 * @property string   $member_id
 * @property string   $member_id
 * @property string   $reviewer_id
 * @property string   $reviewer_id
 * @property DateTime $registration_date
 * @property DateTime $scheduled_date
 * @property DateTime $update_date
 * @property DateTime $scheduled_date
 * @property DateTime $update_date
 */
class SakurasetManage extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sakuraset_manage';

    /**
     * The database edit column updated_at name to update_date.
     *
     * @var string
     */

    const UPDATED_AT = 'update_date';

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
        'member_id', 'member_id', 'reviewer_id', 'reviewer_status', 'scheduled_date', 'update_date', 'registration_date', 'reviewer_id', 'reviewer_status', 'scheduled_date', 'update_date','reviewer_confirmation_flg','confirmation_flg',
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
        'member_id' => 'string', 
        'id' => 'int', 
        'member_id' => 'string', 
        'reviewer_id' => 'string', 
        'reviewer_status' => 'int', 
        'scheduled_date' => 'datetime', 
        'update_date' => 'datetime', 
        'registration_date' => 'datetime', 
        'reviewer_id' => 'string', 
        'reviewer_status' => 'int', 
        'scheduled_date' => 'datetime', 
        'update_date' => 'datetime',
        'reviewer_confirmation_flg',
        'confirmation_flg',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'registration_date', 'scheduled_date', 'update_date', 'scheduled_date', 'update_date'
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
    
    public function made_member()
    {
        return $this->hasOne(UsersAddInfo::class,'login_id','member_id');
    }
    
    public function reviewer_member()
    {
        return $this->hasOne(UsersAddInfo::class,'login_id','reviewer_id');
    }
}
