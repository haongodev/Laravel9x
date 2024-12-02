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


    public const CREATED_AT = 'registration_date';
    public const UPDATED_AT = 'update_date';
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
        'id','member_id', 'question_id','type_native_id', 'registration_year', 'registration_date', 'update_date'
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
