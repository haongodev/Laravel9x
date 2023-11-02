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
        'id',
        'question_id',
        'type_native_id',
        'title',
        'level',
        'parent_question_id',
        'child_list',
        'parent_question_option_id',
        'input_method',
        'score',
        'effective_date_flg',
        'required_flg',
        'terminal_flg',
        'update_date',
        'registration_date',
        'disp_flg',
        'viewing_check_flg'
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
    public function question_option_setting()
    {
        return $this->hasMany(HisQuestionOptionsSettings::class,'question_settings_id','id');
    }
}
