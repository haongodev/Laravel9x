<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int      $id
 * @property int      $type_native_id
 * @property int      $input_method
 * @property int      $level
 * @property int      $original_question_id
 * @property int      $score
 * @property string   $answer
 * @property string   $title
 * @property DateTime $registration_date
 * @property DateTime $update_date
 * @property boolean  $terminal_flg
 */
class AnswerInfo extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'answer_info';

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
        'id','answer_manage_id','original_question_id','type_native_id','title','level','input_method','score','terminal_flg','answer','update_date','registration_date',
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
