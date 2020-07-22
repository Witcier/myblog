<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('notification.index',compact('user'));
    }
}
