<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'class',
        'active_flg',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public $timestamps = ["registration_date"];
    public const CREATED_AT = 'registration_date';
    public const UPDATED_AT = null;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //  protected $appends = ['membership_type'];

    public function getMembershipTypeAttribute()
    {
        $userId = $this->id;
        return DB::table('users_add_info')->where('member_id', $userId)->pluck('membership_type')->first();

    }

    public function user_add_info()
    {
        return $this->hasOne(UsersAddInfo::class,'users_id','id');
    }
}
