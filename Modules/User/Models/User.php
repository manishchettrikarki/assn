<?php

namespace Modules\User\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Modules\InternationalFlight\Models\FlightBooking;
use Modules\InternationalFlight\Models\SearchFlight;
use Modules\User\Scopes\SuperAdminScope;
use Modules\Yeti\Models\YetiBooking;
use Modules\Yeti\Models\YetiSearch;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use SoftDeletes,Notifiable,ThrottlesLogins,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone','is_active','suspended_by','suspended_date','deleted_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $dates = ['suspended_date'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
//    protected $with = ['notifications'];

    public function scopeNotSuperadmin($query){
        return $query->whereHas('roles',function($builder){
            $builder->where('name','!=','Super Admin');
        });
    }

    public function suspendedBy(){
        return $this->belongsTo(User::class,'suspended_by');
    }

    public function deletedBy(){
        return $this->belongsTo(User::class,'deleted_by');
    }

    public function sabreSearch(){
        return $this->hasMany(SearchFlight::class,'user_id');
    }

    public function sabreBooking(){
        return $this->hasMany(FlightBooking::class,'user_id');
    }

    public function yetiSearch(){
        return $this->hasMany(YetiSearch::class,'user_id');
    }

    public function yetiBooking(){
        return $this->hasMany(YetiBooking::class,'created_by');
    }
}
