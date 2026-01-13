<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        
        return view('admin.dashboard', compact('totalUsers'));
    }

    public function userManagement()
    {
        $totalUsers = User::count();

        return view('admin.user-management', compact('totalUsers'));
    }
}
