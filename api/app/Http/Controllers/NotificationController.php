<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index() 
    {
        $notifications = Notification::all();

        if ($notifications->count() > 0) {
            return response()->json(['notifications' => $notifications]);
        } else {
            return response()->json([
                'notifications' => 'No notifications Found'
            ]);
        }
    }
}
