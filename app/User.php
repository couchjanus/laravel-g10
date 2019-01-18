<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hash;
use Cache;

// class User extends Authenticatable
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_admin'
    ];

    /**
     * Атрибуты, которые должны быть преобразованы в даты.
     * @var array
     */

    protected $dates = [
        'deleted_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($input)
    {
        if ($input)
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function social()
    {
        return $this->hasMany('App\Social');
    }

    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
 
    public function permissions()
    {
       return $this->hasManyThrough('App\Permission', 'App\Role');
    }

    /**
     * Checks a Permission
     */
    public function isSuperVisor()
    {
        if ($this->roles->contains('slug', 'admin')) {
            return true;
        }
        return false;
    }

    public function hasRole($role)
    {
        if ($this->isSuperVisor()) {
            return true;
        }
        if (is_string($role)) {
            return $this->role->contains('slug', $role);
        }
        return !! $this->roles->intersect($role)->count();
    }

}
