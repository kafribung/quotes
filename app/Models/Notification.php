<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $touches = ['quote', 'user'];
    protected $guarded = ['created_at', 'updated_at'];

    // Many to to (Notification to user)
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    // Many to to (Notification to user)
    public function quote()
    {
        return $this->belongsTo('App\Models\Quote');
    }
}
