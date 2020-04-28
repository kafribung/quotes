<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Import Db COmment
use App\Models\Comment;

// Import Db Quote
use App\Models\Quote;

// Impotr DB Notification
use App\Models\Notification;

// Import DB yang Login
use Auth;


class CommentController extends Controller
{
    //CREATE
    public function store(Request $request, $id)
    {
        $request->validate([
            'comment' => ['required', 'string', 'min:3']
        ]);

        $quote   = Quote::findOrFail($id);

        $comment = $request->user()->comments()->create([
            'comment'  => $request->comment,
            'quote_id' => $id
        ]);

        // Notification
        Notification::create([
            'user_id'  => $quote->user->id,
            'quote_id' => $id,
            'subject'  => 'Di komemntari oleh '. Auth::user()->name
        ]);

        return redirect('/quotes/'. $quote->slug)->with( 'msg', 'Comment Successfully Added');
    }

    // EDIT
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);

        return view('quotesComment.commentEdit', compact('comment'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {

        $comment = Comment::findOrFail($id);

        $request->validate([
            'comment' => ['required', 'string', 'min:3']
        ]);
        // User_id dan Quote_id (Otomatis)

        if ($comment->isOwner()) {
            Comment::findOrFail($id)->update([
                'comment'  => $request->comment
            ]);
        } else return abort(404, 'Anda keliru !');


        return  redirect('/quotes/'. $comment->quote->slug)->with('msg', 'Comment  Update Successfully !');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        if ($comment->isOwner()) {
            Comment::destroy($id);
        } else return abort(404, 'Anda keliru !');


        return redirect('/quotes/' . $comment->quote->slug)->with('msg', 'Comment Successfully Deleted !');
    }
}
