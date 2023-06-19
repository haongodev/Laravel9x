<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int      $id
 * @property int      $id
 * @property int      $target_year
 * @property int      $training_type
 * @property int      $active_flg
 * @property int      $target_year
 * @property int      $training_type
 * @property boolean  $active_flg
 * @property DateTime $closing_date
 * @property DateTime $delete_date
 * @property DateTime $effective_date
 * @property DateTime $registration_date
 * @property DateTime $start_date
 * @property DateTime $update_date
 * @property DateTime $closing_date
 * @property DateTime $delete_date
 * @property DateTime $effective_date
 * @property DateTime $registration_date
 * @property DateTime $start_date
 * @property DateTime $update_date
 * @property string   $title
 * @property string   $title
 */
class UpdateTrainingManage extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'update_training_manage';

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
        'active_flg', 'closing_date', 'delete_date', 'effective_date', 'registration_date', 'start_date', 'target_year', 'title', 'training_type', 'update_date', 'active_flg', 'closing_date', 'delete_date', 'effective_date', 'registration_date', 'start_date', 'target_year', 'title', 'training_type', 'update_date'
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
        'id' => 'int', 'id' => 'int', 'active_flg' => 'boolean', 'closing_date' => 'datetime', 'delete_date' => 'datetime', 'effective_date' => 'datetime', 'registration_date' => 'datetime', 'start_date' => 'datetime', 'target_year' => 'int', 'title' => 'string', 'training_type' => 'int', 'update_date' => 'datetime', 'active_flg' => 'int', 'closing_date' => 'datetime', 'delete_date' => 'datetime', 'effective_date' => 'datetime', 'registration_date' => 'datetime', 'start_date' => 'datetime', 'target_year' => 'int', 'title' => 'string', 'training_type' => 'int', 'update_date' => 'datetime'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'closing_date', 'delete_date', 'effective_date', 'registration_date', 'start_date', 'update_date', 'closing_date', 'delete_date', 'effective_date', 'registration_date', 'start_date', 'update_date'
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
