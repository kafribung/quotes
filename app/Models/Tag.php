<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    // Mnay to many (Tag to Quote)
    public function quotes()
    {
        return $this->belongsToMany('App\Models\Quote');
    }
}
