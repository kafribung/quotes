<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Import DB Like
use App\Models\Like;

// Import DB Yg Login
use Auth;

// Import DB Quote
use App\Models\Quote;

// Import DB Comment
use App\Models\Comment;




class LikeController extends Controller
{
    public function like($model_id, $type)
    {
        if ($type == 1) {
            $type    = "App\Models\Quote";
            $isOwner = Quote::findOrFail($model_id)->user->id;
            $model   = Quote::findOrFail($model_id);
        }
        else  {
            $type    = "App\Models\Comment";
            $isOwner = Comment::findOrFail($model_id)->user->id;
            $model   = Comment::findOrFail($model_id);

        }

        // Tidak bisa like diri sendiri
        if (Auth::user()->id == $isOwner) {
            die('0');
        }


        // Tidak bisa like berulang kali
        if ($model->multi_like() == null) {
            $like = Like::create([
                'user_id'       => Auth::user()->id,
                'likeable_id'   => $model_id,
                'likeable_type' => $type
            ]);
        }
    }

    // UNLIKE
    public function unlike($model_id, $type)
    {
        if ($type == 1) {
            $type = "App\Models\Quote";
            $model= Quote::findOrFail($model_id);
        } else {
            $type = "App\Models\Comment";
            $model= Comment::findOrFail($model_id);
        }

        if ($model->multi_like()) {
            $like = Like::where('likeable_id', $model_id)
                    ->where('likeable_type', $type)
                    ->where('user_id', Auth::user()->id)
                    ->delete();
        }

    }
}
