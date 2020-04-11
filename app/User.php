<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    public function cemeteries()
    {
        return $this->belongsToMany(Cemetery::class, 'users_cemeteries');
    }
    
    public function getCemeteryIdAttribute()
    {
        if (session()->has('cemetery_id')) {
            return session()->get('cemetery_id');
        }

        return null;
    }

    public function getCemeteryAppellationAttribute()
    {
        if (session()->has('cemetery_appellation')) {
            return session()->get('cemetery_appellation');
        }

        return null;
    }
}
