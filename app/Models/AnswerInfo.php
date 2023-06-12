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
        'type_native_id', 'answer', 'input_method', 'level', 'original_question_id', 'registration_date', 'score', 'terminal_flg', 'title', 'update_date'
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
        'id' => 'int', 'type_native_id' => 'int', 'answer' => 'string', 'input_method' => 'int', 'level' => 'int', 'original_question_id' => 'int', 'registration_date' => 'datetime', 'score' => 'int', 'terminal_flg' => 'boolean', 'title' => 'string', 'update_date' => 'datetime'
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
