<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class GuidanceSetting
 * @package App\Models
 */
class GuidanceSetting extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'guidance_settings';

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
        'active_flg', 'guidance', 'location_id', 'registration_date', 'screen_id', 'sentence_class', 'update_date', 'active_flg', 'guidance', 'location_id', 'registration_date', 'screen_id', 'sentence_class', 'update_date'
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
        'id' => 'int', 'id' => 'int', 'active_flg' => 'boolean', 'guidance' => 'string', 'location_id' => 'int', 'registration_date' => 'datetime', 'screen_id' => 'int', 'sentence_class' => 'int', 'update_date' => 'datetime', 'active_flg' => 'boolean', 'guidance' => 'string', 'location_id' => 'int', 'registration_date' => 'datetime', 'screen_id' => 'int', 'sentence_class' => 'int', 'update_date' => 'datetime'
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
