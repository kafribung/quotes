<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Impotr DB User yang login
use Auth;

trait TraitLike
{
    // ----------------------- polymorphic (One to Many) LIKE
    public function likes()
    {
        return $this->morphMany('App\Models\Like', 'likeable');
    }

    //  Like diri berulang kali
    public function multi_like()
    {
        return $this->likes()->where('user_id', Auth::user()->id)->count();
    }
}
