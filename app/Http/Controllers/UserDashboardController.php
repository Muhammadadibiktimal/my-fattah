<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
    {
        return view('user.dashboard');
    }

    public function data()
    {
        return view('user.data');
    }

    public function status()
    {
        return view('user.status');
    }

    public function bukti()
    {
        return view('user.bukti');
    }
}
