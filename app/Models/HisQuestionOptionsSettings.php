<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string   $class_name
 * @property string   $option_name
 * @property int      $question_id
 * @property int      $question_settings_id
 * @property int      $score
 * @property int      $sort_order
 * @property int      $type_native_id
 * @property DateTime $registration_date
 * @property DateTime $update_date
 */
class HisQuestionOptionsSettings extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'his_question_options_settings';

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
        'class_name', 'option_name', 'question_id', 'question_settings_id', 'registration_date', 'score', 'sort_order', 'type_native_id', 'update_date'
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
        'class_name' => 'string', 'option_name' => 'string', 'question_id' => 'int', 'question_settings_id' => 'int', 'registration_date' => 'datetime', 'score' => 'int', 'sort_order' => 'int', 'type_native_id' => 'int', 'update_date' => 'datetime'
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
