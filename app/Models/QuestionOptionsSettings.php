<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class QuestionOptionsSettings
 * @package App\Models
 */
class QuestionOptionsSettings extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'question_options_settings';

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
        'type_native_id', 'class_name', 'option_name', 'question_id', 'registration_date', 'score', 'sort_order', 'update_date', 'class_name', 'option_name', 'question_id', 'registration_date', 'score', 'sort_order', 'update_date'
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
        'id' => 'int', 'question_settings_id' => 'int', 'type_native_id' => 'int', 'class_name' => 'string', 'option_name' => 'string','score' => 'int', 'registration_date' => 'datetime:Y-m-d H:i:s',  'sort_order' => 'int', 'update_date' => 'datetime:Y-m-d H:i:s'
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
