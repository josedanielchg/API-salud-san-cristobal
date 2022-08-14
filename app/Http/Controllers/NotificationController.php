<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
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
            'email' => 'required|exists:App\Models\User,email|email',
            'title' => 'required|string',
            'body' => 'required|string',
        ]);

        $user = User::where('email', $fields['email'])->first();

        $abstract = substr($fields['body'], 0, 100) . "...";

        $notification = Notification::create([
            'user_id' => $user->id,
            'title' => $fields['title'],
            'body' => $fields['body'],
            'abstract' => $abstract,
            'seen' => 0 
        ]);

        $response = [
            'message' => 'Notificacion creada exitosamente',
            'data' => $notification,
        ];

        return response($response, 201);
    }


    public function notifications($user_id)
    {
        $notifications = Notification::where('user_id', $user_id)->orderBy('seen')->get();

        $response = [
            'message' => "Notificaciones - Usuario: $user_id",
            'data' =>  $notifications
        ];

        return response($response, 200);
    }

    
    public function notification_seen(Request $request, $id)
    {
        $notification = Notification::find($id);

        // Check if new exists user
        if(!$notification) {
            return response([
                'message' => 'Error. Notificacion no encontrada',
            ], 400);
        }

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
