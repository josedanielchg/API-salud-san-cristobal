<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validation
        $fields = $request->validate([
            'user_id' => 'required|exists:App\Models\User,id',
            'title' => 'required|string',
            'body' => 'required|string',
        ]);

        $notification = Notification::create([
            'user_id' => $fields['user_id'],
            'title' => $fields['title'],
            'body' => $fields['body'],
            'seen' => 0 
        ]);

        $response = [
            'message' => 'Notificacion creada exitosamente',
            'data' => $notification,
        ];

        return response($response, 201);
    }

    
    public function notification_seen(Request $request, $id)
    {
        $notification = Notification::find($id);

        $notification->update([
            'seen' => 1
        ]);

        $response = [
            'message' => 'Notificacion actualizada exitosamente',
            'data' => $notification,
        ];

        return response($response, 201);
    }

}
