<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $notifications = auth()->user()->notifications()
                ->orderBy('checked', 'asc')
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            return NotificationResource::collection($notifications);
        }

        return view('notifications.index');
    }

    /**
     * Display the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Notification $notification)
    {
        if (!$notification->checked) {
            $notification->update([
                'checked' => true,
                'checked_at' => now()
            ]);
        }

        return redirect()->to($notification->url);
    }

    /**
     * Mark the notification as checked.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function markAsChecked(Notification $notification)
    {
        $notification->update([
            'checked' => true,
            'checked_at' => now()
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Successfully checked the notification.',
            'data' => []
        ]);
    }
}
