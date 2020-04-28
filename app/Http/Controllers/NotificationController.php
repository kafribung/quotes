<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Import DB Notification
use App\Models\Notification;

// Import Db yang login
use Auth;

class NotificationController extends Controller
{
    public function notification()
    {
        $notifications = Notification::with('quote')->where('user_id', Auth::user()->id)->orderBy('id', 'ASC')->get();

        $updateNotif = Notification::where('user_id', Auth::user()->id);



        return view('quoteNotification.notification', compact('notifications', 'updateNotif'));
    }

    public function destroy($id)
    {
        $notification = Notification::destroy($id);

        return redirect('/notification')->with('msg', 'Notification delete succsess !');
    }
}
