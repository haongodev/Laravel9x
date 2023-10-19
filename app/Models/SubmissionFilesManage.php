<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SubmissionFilesManage
 * @package App\Models
 */
class SubmissionFilesManage extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'submission_files_manage';

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
        'agreement_date', 'agreement_flg', 'agreement_user_id', 'delete_date', 'file_name', 'file_type', 'member_id', 'registration_date', 'share_member_id', 'update_date', 'agreement_date', 'agreement_flg', 'agreement_user_id', 'delete_date', 'file_name', 'file_type', 'member_id', 'registration_date', 'share_member_id', 'update_date'
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
        'id' => 'int', 'id' => 'int', 'agreement_date' => 'datetime', 'agreement_flg' => 'boolean', 'agreement_user_id' => 'int', 'delete_date' => 'datetime', 'file_name' => 'string', 'file_type' => 'int', 'member_id' => 'string', 'registration_date' => 'datetime', 'share_member_id' => 'string', 'update_date' => 'datetime', 'agreement_date' => 'datetime', 'agreement_flg' => 'int', 'agreement_user_id' => 'int', 'delete_date' => 'datetime', 'file_name' => 'string', 'file_type' => 'int', 'member_id' => 'string', 'registration_date' => 'datetime', 'share_member_id' => 'string', 'update_date' => 'datetime'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'agreement_date', 'delete_date', 'registration_date', 'update_date', 'agreement_date', 'delete_date', 'registration_date', 'update_date'
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
