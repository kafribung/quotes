<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Import Db yg login
use Auth;

class Comment extends Model
{
    protected $touches = ['user', 'quote'];
    protected $guarded =  ['created_at', 'updated_at'];

    // Many to One (Comment to user)
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    // Many to One (Comment to quote)
    public function quote()
    {
        return $this->belongsTo('App\Models\Quote');
    }



    // Hidden Fitur
    public function isOwner()
    {
        $user = Auth::guest();

        if ($user) {
            return false;
        } else return Auth::user()->id == $this->user->id;
    }

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
