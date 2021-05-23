<?php

namespace App;

use App\User as BasicUser;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends BasicUser
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected static function boot()
    {
        parent::boot ();

        static::deleting(function ($employee){
            $employee->user->phones()->delete();

        });

    }
    static function type()
    {
        $array=
            [
                0         => 'كاشير',
                1         => 'محاسب',
                2         => 'صاله مان',
                3         => 'مدير المخزن',
                4         => 'الشيف',
                5         => 'ديليفري مان',
            ];
        return $array;
    }
    // get type
    public function getTypeeAttribute()
    {
        return self::type()[$this->type];
    }
    static function status()
    {
        $array =
            [
                0 => 'غير مفعل',
                1 => 'مفعل',
            ];
        return $array;
    }
    public function getStatussAttribute()
    {
        return self::status()[$this->status];
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }


}
