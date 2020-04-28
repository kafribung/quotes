<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Import Db yg login
use Auth;

class Quote extends Model
{
    protected $touches = ['user'];
    protected $guarded = ['created_at', 'updated_at'];

    // Many to One (Quote to User)
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }



    // RELASI ONE TO MANY (Comment)

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    //RELASI MANY TO MANY (Tag)
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }

    // RELASI ONE TO MANY (Notification)
    public function notifications()
    {
        return $this->hasMany('App\Models\Notification');
    }



     // Hidden Fitur
     public function isOwner()
     {
         if (Auth::guest()) {
             return false;
         } else return $this->user->id == Auth::user()->id;

     }

     // Harus Login
     public function isLogin()
     {
         if (Auth::check()) {
             return true;
         } else return false;

     }

    // ----------------------- polymorphic (One to Many) LIKE
    //  Like diri berulang kali
    // METHOD YANG SAMA SUDAH DI TRAIT
    use TraitLike;



}
