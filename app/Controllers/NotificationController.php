<?php

namespace App\Controllers;

use App\Models\NotificationModel;

class NotificationController extends BaseController
{
    protected $notificationModel;

    public function __construct()
    {
        $this->notificationModel = new NotificationModel();
    }

    public function bacaSemua()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('login');
        }

        $this->notificationModel->markAllRead(session()->get('user_id'));
        return redirect()->back();
    }
}