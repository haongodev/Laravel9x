<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class QuestionSettings
 * @package App\Models
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
        'parent_question_id',
        'question_display_id',
        'question_id',
        'type_native_id',
        'input_method',
        'level',
        'registration_date',
        'score',
        'effective_date_flg',
        'required_flg',
        'title',
        'update_date',
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
        'type_native_id' => 'int',
        'input_method' => 'int',
        'level' => 'int',
        'registration_date' => 'datetime:Y-m-d H:i:s',
        'score' => 'int',
        'title' => 'string',
        'update_date' => 'datetime:Y-m-d H:i:s',
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

    public function question_option_setting()
    {
        return $this->hasMany(QuestionOptionsSettings::class,'question_settings_id','id');
    }
}
