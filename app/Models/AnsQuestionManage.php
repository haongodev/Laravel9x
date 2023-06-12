<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int      $id
 * @property int      $registration_year
 * @property int      $type_native_id
 * @property string   $member_id
 * @property boolean  $active_flg
 * @property DateTime $registration_date
 * @property DateTime $update_date
 */
class AnsQuestionManage extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ans_question_manage';

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
        'member_id', 'registration_year', 'type_native_id', 'active_flg', 'registration_date', 'update_date'
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
        'id' => 'int', 'member_id' => 'string', 'registration_year' => 'int', 'type_native_id' => 'int', 'active_flg' => 'boolean', 'registration_date' => 'datetime', 'update_date' => 'datetime'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'registration_date', 'update_date'
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
