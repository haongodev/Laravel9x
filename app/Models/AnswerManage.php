<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int      $id
 * @property int      $question_id
 * @property int      $registration_year
 * @property int      $active_flg
 * @property string   $member_id
 * @property DateTime $registration_date
 * @property DateTime $update_date
 */
class AnswerManage extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'answer_manage';

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
        'member_id', 'question_id', 'registration_year', 'active_flg', 'registration_date', 'update_date'
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
        'id' => 'int', 'member_id' => 'string', 'question_id' => 'int', 'registration_year' => 'int', 'active_flg' => 'int', 'registration_date' => 'datetime', 'update_date' => 'datetime'
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
