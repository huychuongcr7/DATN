<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\View\View;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $notifications = Notification::orderByDESC('created_at')->get();
        return view('admin.notifications.index', compact('notifications'));
    }

    public function show($id)
    {
        $notification = Notification::find($id);
        if ($notification->status == Notification::STATUS_UNREAD) {
            $notification->update([
                'status' => Notification::STATUS_READ
            ]);
        }
        return view('admin.notifications.show', compact('notification'));
    }
}
