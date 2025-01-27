<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // $expoTokens = User::whereNotNull('expo_token')->pluck('expo_token')->toArray();
        // sendPushNotification($expoTokens, 'Hello from Laravel', 'This is a test notification');
        return view('admin.dashboard');
    }
}
