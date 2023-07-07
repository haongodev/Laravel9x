<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int      $input_method
 * @property int      $level
 * @property int      $question_id
 * @property int      $score
 * @property int      $type_native_id
 * @property DateTime $registration_date
 * @property DateTime $update_date
 * @property boolean  $terminal_flg
 * @property string   $title
 */
class HisQuestionSettings extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'his_question_settings';

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
        'input_method', 'level', 'parent_question_id', 'parent_question_option_id', 'question_id', 'registration_date', 'score', 'terminal_flg', 'title', 'type_native_id', 'update_date'
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
        'input_method' => 'int', 'level' => 'int', 'question_id' => 'int', 'registration_date' => 'datetime', 'score' => 'int', 'terminal_flg' => 'boolean', 'title' => 'string', 'type_native_id' => 'int', 'update_date' => 'datetime'
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
