<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int      $id
 * @property int      $type_native_id
 * @property int      $id
 * @property int      $type_native_id
 * @property int      $input_method
 * @property int      $level
 * @property int      $score
 * @property int      $input_method
 * @property int      $level
 * @property int      $score
 * @property DateTime $registration_date
 * @property DateTime $update_date
 * @property DateTime $registration_date
 * @property DateTime $update_date
 * @property string   $title
 * @property string   $title
 */
class QuestionSettings extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'question_settings';

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
        'parent_question_id', 'question_display_id', 'question_id', 'type_native_id', 'parent_question_id', 'question_display_id', 'question_id', 'type_native_id', 'input_method', 'level', 'registration_date', 'score', 'title', 'update_date', 'input_method', 'level', 'registration_date', 'score', 'title', 'update_date'
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
        'id' => 'int', 'type_native_id' => 'int', 'id' => 'int', 'type_native_id' => 'int', 'input_method' => 'int', 'level' => 'int', 'registration_date' => 'datetime', 'score' => 'int', 'title' => 'string', 'update_date' => 'datetime', 'input_method' => 'int', 'level' => 'int', 'registration_date' => 'datetime', 'score' => 'int', 'title' => 'string', 'update_date' => 'datetime'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'registration_date', 'update_date', 'registration_date', 'update_date'
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
