<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;

class NotificationsController extends Controller
{
    public function index(Request $request)
    {
        $from = $request->from ?? date('Y-m-1');
        $to = $request->to ?? now();

        $data = array(
            'title' => 'All Notifications',
            'notifications' =>  Admin::find(auth()->user()->id)->notifications()->whereBetween('created_at', [$from, $to])->get()
        );

        return view('admin.notifications.all_notifications')->with($data);
    }

    public function clear(Request $request){
        if($request->id == 'all'){
            Admin::find(auth()->user()->id)->unreadNotifications->markAsRead();
            return response()->json([
                'success' => "All notifications has been marked read!",
                'reload' => true
            ]);
        }

        Admin::find(auth()->user()->id)->notifications()->where('id', $request->id)->update(['read_at' => now()]);
        return response()->json([
            'success' => "Notification has been marked read!",
            'reload' => true
        ]);

    }

    public function delete(Request $request)
    {
        Admin::find(auth()->user()->id)->notifications()->where('id', $request->id)->delete();
        return response()->json([
            'success' => "Notification has been deleted!",
            'reload' => true
        ]);
    }
}
