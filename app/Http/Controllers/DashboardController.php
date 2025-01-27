<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return sendPushNotification('', 'Hello from Laravel', 'This is a test notification');

        return view('admin.dashboard');
    }
}
