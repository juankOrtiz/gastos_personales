<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $id)
    {
        // Encontrar la notificación por su ID
        $notification = DatabaseNotification::find($id);

        // Marcar la notificacion como leida
        $notification->markAsRead();

        // Redirigir a donde gusten
        return back();
    }
}
