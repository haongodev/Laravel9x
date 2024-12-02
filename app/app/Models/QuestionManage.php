<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class QuestionManage
 * @package App\Models
 */
class QuestionManage extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'question_manage';

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
        'id', 'type_native_id', 'active_flg', 'update_date', 'registration_date',
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
        'id' => 'int', 'type_native_id' => 'int',  'active_flg' => 'int', 'update_date' => 'datetime','registration_date' => 'datetime',
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
