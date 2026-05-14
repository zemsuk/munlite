<?php

namespace App\dashboard;

use App\Controller;
use App\Auth\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        $user = User::find($_SESSION['user_id']);
        return view('Dashboard/views/dashboard', ['user' => $user]);
    }
}