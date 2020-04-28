<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

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

    // One to Many (Quote)
    public function quotes()
    {
        return $this->hasMany('App\Models\Quote');
    }

    // One to Many (Comment)
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    // One to Many (Notification)
    public function notifications()
    {
        return $this->hasMany('App\Models\Notification');
    }


}
