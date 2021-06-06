<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;


class User extends Authenticatable
{
    use Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','type','status','is_admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = ['deleted_at'];



    static function type()
    {
        $array=
            [
                0         => 'عميل',
                1         => 'موظف',
                2         => 'أدمن',
            ];
        return $array;
    }
    // get type
    public function getTypeeAttribute()
    {
        return self::type()[$this->type];
    }

    public function employee()
    {
        return $this->hasOne(Employee::class,'user_id');
    }

    public function client()
    {
        return $this->hasOne(Client::class,'user_id');
    }
    public function phones()
    {
        return $this->hasMany(Phone::class,'user_id');
    }

    public function workPeriods()
    {
        return $this->hasMany(WorkPeriod::class,'user_id');
    }

    public function bankTransactions()
    {
        return $this->hasMany(BankTransaction::class,'user_id');
    }

    public function ScopeGetNumbersPhones($query,$user)
    {
        $phones = $user->phones->pluck('number');
         return $phones->implode(' - ','number');

    }
    public function ScopeUserLog($query)
    {
        $actworkperiods = WorkPeriod::where('status',1)->pluck('user_id')->toArray();

        if (in_array(Auth::id(),$actworkperiods) )
            return true;
        return false;
    }

}
